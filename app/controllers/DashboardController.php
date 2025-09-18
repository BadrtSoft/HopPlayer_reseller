<?php

namespace App\Controllers;

class DashboardController extends Controller
{
    public function index() {
        response()->render('dashboard', [
            'page_title' => 'Dashboard',
            'reseller' => auth()->user()
        ]);
    }
}
