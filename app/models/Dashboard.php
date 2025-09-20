<?php

namespace App\Models;

class Dashboard extends Model {
    public static function getCreditSpent($userID){
        return db()->query("SELECT SUM(credit) as total_credit FROM credits_logs WHERE reseller_id = ?")->bind($userID)->fetchAssoc();
    }

    public static function getActivatedDevices($userID, $dateFrom = null){
        if(!$dateFrom) return db()->query("SELECT COUNT(id) as total_activated_devices FROM activation_logs WHERE reseller_id = ?")->bind($userID)->fetchAssoc();
        if($dateFrom) return db()->query("SELECT COUNT(id) as total_activated_devices FROM activation_logs WHERE reseller_id = ? AND action_date > ?")->bind($userID, strtotime($dateFrom))->fetchAssoc();
    }

    public static function getResellersCount($ownerID){
        return db()->query("SELECT COUNT(id) as total_resellers FROM resellers WHERE owner_id = ?")->bind($ownerID)->fetchAssoc();
    }

}