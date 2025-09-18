<?php

namespace App\Models;

class Playlist extends Model {
    public static $_table = 'playlists';
    public static function addFromXtreamCodes($data) {
        // Validate input
        $insert = db()->insert(self::$_table)->params([
            'playlist_name' => $data['name'] ?? null,
            'device_id' => $data['url'] ?? null,
            'paylist_Infos' => [
                "protocol" => $data['protocol'] ?? "http",
                "hostname" => $data['hostname'] ?? null,
                "port" => $data['port'] ?? null,
                "username" => $data['username'] ?? null,
                "password" => $data['password'] ?? null,
            ],
            'added_at' => time()
        ])->execute();
        if($insert !== 0 && $insert !== false && $insert !== "0") return true;
        return false;
    }

    public static function addFromUrl($data) {
        // Validate input
        $urlParts = parse_url($data['url'] ?? '');
        if(!$urlParts || !isset($urlParts['scheme']) || !isset($urlParts['host'])) {
            return false;
        }
        $insert = db()->insert(self::$_table)->params([
            'playlist_name' => $data['name'] ?? null,
            'device_id' => $data['device_id'] ?? null,
            'paylist_Infos' => json_encode([
                "protocol" => $urlParts['scheme'],
                "hostname" => $urlParts['host'],
                "port" => $urlParts['port'] ?? null,
                "username" => $urlParts['user'] ?? null,
                "password" => $urlParts['pass'] ?? null,
            ]),
            'added_at' => time()
        ])->execute();
        if($insert !== 0 && $insert !== false && $insert !== "0") return true;
        return false;
    }
}
