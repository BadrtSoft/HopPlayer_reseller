<?php

namespace App\Models;

class Log extends Model {
    public static $_creditsTable = 'credits_logs';
    public static $_activationsTable = 'activation_logs';


    public static function insertCreditsLog($data) {
        $db = db()->connection();
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ':' . $col, $columns);
        $sql = "INSERT INTO " . self::$_creditsTable . " (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $placeholders) . ")";
        $stmt = $db->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();
        return $db->lastInsertId();

        // db()->insert(self::$_creditsTable)->params($data)->execute();
        // return db()->lastInsertId();
    }

    public static function insertActivationLog($data) {
        $db = db()->connection();
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ':' . $col, $columns);
        $sql = "INSERT INTO " . self::$_activationsTable . " (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $placeholders) . ")";
        $stmt = $db->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();
        return $db->lastInsertId();
        // db()->insert(self::$_activationsTable)->params($data)->execute();
        // return db()->lastInsertId();
    }

}
