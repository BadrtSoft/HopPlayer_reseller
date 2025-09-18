<?php

namespace App\Models;

class Device extends Model {
    public static $_table = 'devices';
    // public static $primaryKey = 'id';

    // Add any device-specific methods or properties here
    public static function findByMac($mac, $fields = 'SQL_CACHE *') {
        return db()->select(self::$_table, $fields)->where('mac_address', "=", $mac)->fetchAssoc();
    }

    public static function edit($deviceId, $data) {
        if(!$deviceId) return false;
        $update = db()->update(self::$_table)->params($data)->where('id', '=', $deviceId)->execute();
        if($update !== 0 && $update !== false && $update !== "0") return true;
        return false;
    }
}
