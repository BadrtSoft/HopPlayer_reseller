<?php

namespace App\Controllers;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use \Lib\Token;
use App\Models\Device;
use App\Models\Log;

class ActivationsController extends Controller {

    public static $durations = [
        0 => ["credits" => 3, "duration" => null],
        1 => ["credits" => 1, "duration" => "1 year"],
        2 => ["credits" => 2, "duration" => "2 years"]
    ];

    public function index(){
        response()->render('activation', [
            "page_title" => "Device Activation",
            "description" => "Activate your device here.",
            'reseller' => auth()->user(),
            '_token' => Token::generate("activate_device")
        ]);
    }

    public function deviceInfo() {
        if(!Token::check(request()->body()['_token'] ?? '', "activate_device")) {
            return response()->json(['success' => false, 'error' => 'Invalid CSRF token'], 200);
        }
        $mac = request()->body()["device_mac"] ?? null;
        if(!$mac) return response()->json(['success' => false,'error' => 'Device MAC address is required', '_token' => Token::generate("activate_device")], 200);

        $device = Device::findByMac($mac, 'SQL_CACHE *');
        // die(var_dump($device));
        if(!$device) return response()->json(['success' => false, 'error' => 'Device not found', '_token' => Token::generate("activate_device")], 200);
        // var_dump($device);
        return response()->json([
            'success' => true,
            'data' => [
                "mac" => $mac,
                "device_id" => $device['id'],
                "activated" => ($device["expire_date"] === null || $device["expire_date"] > time()) ? true : false,
                "added_at" => date("Y-m-d H:i:s", $device["added_at"]),
                "expire_date" => $device["expire_date"] ? date("Y-m-d H:i:s", $device["expire_date"]) : "Never",
            ],
            '_token' => Token::generate("activate_device")
        ], 200);
    }

    public function activateDevice() {
        // if(!Token::check(request()->body()['_token'] ?? '', "activate_device")) {
        //     return response()->json(['success' => false, 'error' => 'Invalid CSRF token'], 200);
        // }
        $data = request()->body();
        $mac = $data["device_mac"] ?? null;
        if(!$mac) return response()->json(['success' => false,'error' => 'Device MAC address is required', '_token' => Token::generate("activate_device")], 200);
        $device = Device::findByMac($mac, 'SQL_CACHE *');
        if(!$device) return response()->json(['success' => false, 'error' => 'Device not found', '_token' => Token::generate("activate_device")], 200);
        $duration = $data["duration"] ?? null;
        if($duration < 0 || !is_numeric($duration) || !in_array($duration, array_keys(self::$durations))) {
            return response()->json(['success' => false, 'error' => 'Invalid duration', '_token' => Token::generate("activate_device")], 200);
        }
        if($device["expire_date"] === null || $device["expire_date"] > time()) {
            return response()->json(['success' => false, 'error' => 'Device already activated', '_token' => Token::generate("activate_device")], 200);
        }
        $reseller = auth()->user();
        if($reseller->credits < self::$durations[$duration]["credits"]) {
            return response()->json(['success' => false, 'error' => 'Not enough credits', '_token' => Token::generate("activate_device")], 200);
        }
        $expireDate = (self::$durations[$duration]["duration"] === null) ? null : strtotime("+" . self::$durations[$duration]["duration"] . ""); // Convert days to seconds
        $deviceUpdate = Device::edit($device["id"], [
            "expire_date" => $expireDate,
            "activated_at" => time()
        ]);
        if($deviceUpdate){
            $res = auth()->update([
                "credits" => $reseller->credits - self::$durations[$duration]["credits"]
            ]);
            if(!$res) {
                // Rollback device activation
                Device::edit($device["id"], [
                    "expire_date" => $device["expire_date"],
                    "activated_at" => $device["activated_at"]
                ]);
                response()->json(['success' => false, 'error' => 'Failed to deduct credits from your account. Please contact support.', '_token' => Token::generate("activate_device")], 200);
            }

            $activationLogID = Log::insertActivationLog([
                'reseller_id' => $reseller->id,
                'device_id' => $device['id'],
                'credits_used' => self::$durations[$duration]["credits"],
                'action' => 'device_activation',
                'action_date' => time()
            ]);

            Log::insertCreditsLog([
                'reseller_id' => $reseller->id,
                'credit' => self::$durations[$duration]["credits"],
                'credits_before' => $reseller->credits,
                'credits_after' => $reseller->credits - self::$durations[$duration]["credits"],
                'action_id' => $activationLogID,
                'description' => 'Used for activating device (Mac: ' . $device['mac_address'] . ')',
                'reason' => 'device_activation',
                'action_date' => time()
            ]);
            return response()->json(['success' => true, 'message' => 'Device activated successfully', '_token' => Token::generate("activate_device")], 200);
            
        }
    }
}
