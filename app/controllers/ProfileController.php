<?php

namespace App\Controllers;

class ProfileController extends Controller
{
    public function index() {
        response()->render('profile', [
            "page_name" => "My Profile",
            "reseller" => auth()->user()
        ]);
    }
}
