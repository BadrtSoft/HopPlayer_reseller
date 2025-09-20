<?php

namespace App\Models;

class Reseller extends Model {
    public static function all($columns = '*'){
        return db()->query("SELECT $columns FROM resellers")->fetchAll();
    }

    public static function findByOwner($ownerId, $columns = '*'){
        return db()->query("SELECT $columns FROM resellers WHERE owner_id = ?")->bind($ownerId)->fetchAssoc();
    }

    public static function allByOwner($ownerId, $columns = '*'){
        return db()->query("SELECT $columns FROM resellers WHERE owner_id = ?")->bind($ownerId)->fetchAll();
    }

    public static function findById($id, $columns = '*'){
        return db()->query("SELECT $columns FROM resellers WHERE id = ?")->bind($id)->fetchAssoc();
    }

    public static function findByUsername($username, $columns = '*'){
        return db()->query("SELECT $columns FROM resellers WHERE username = ?")->bind($username)->fetchAssoc();
    }

    public static function create($data){
        return db()->query("INSERT INTO resellers (username, password, credits, owner_id, created_at) VALUES (?, ?, ?, ?, ?)")
            ->bind($data['username'], password_hash($data['password'], PASSWORD_BCRYPT), $data['credits'], auth()->user()->id, time())
            ->execute();
    }

    public static function remove($resellerId){
        return db()->query("DELETE FROM resellers WHERE id = ?")
            ->bind($resellerId)->execute();
    }
}
