<?php

namespace App\Controllers;
use \Lib\Token;
use App\Models\Device;

class ActivationsController extends Controller {
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
        if(!Token::check(request()->body()['_token'] ?? '', "activate_device")) {
            return response()->json(['success' => false, 'error' => 'Invalid CSRF token'], 200);
        }
        $data = request()->body();
        $mac = $data["device_mac"] ?? null;
        $days = isset($data["days"]) ? (int)$data["days"] : 0;
        if(!$mac) return response()->json(['success' => false,'error' => 'Device MAC address is required', '_token' => Token::generate("activate_device")], 200);
        if($days <= 0) return response()->json(['success' => false,'error' => 'Days must be a positive integer', '_token' => Token::generate("activate_device")], 200);

        $device = Device::findByMac($mac, 'SQL_CACHE *');
        if(!$device) return response()->json(['success' => false, 'error' => 'Device not found', '_token' => Token::generate("activate_device")], 200);
        if($device["expire_date"] !== null && $device["expire_date"] <= time()) {
            // Device is expired, set new expire date
            $newExpireDate = time() + ($days * 86400);
        } else {
            // Device is active or never expires, extend expire date
            $currentExpireDate = $device["expire_date"] ?? time();
            $newExpireDate = $currentExpireDate + ($days * 86400);
        }

        $update = Device::edit($device['id'], [
            'expire_date' => $newExpireDate
        ]);
        if($update) {
            return response()->json([
                'success' => true,
                'message' => "Device activated successfully.",
                'data' => [
                    "mac" => $mac,
                    "device_id" => $device['id'],
                    "added_at" => date("Y-m-d H:i:s", $device["added_at"]),
                    "expire_date" => date("Y-m-d H:i:s", $newExpireDate),
                ],
                '_token' => Token::generate("activate_device")
            ], 200);
        } else {
            return response()->json(['success' => false, 'error' => 'Failed to activate device', '_token' => Token::generate("activate_device")], 200);
        }   
    }
}
