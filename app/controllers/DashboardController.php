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

    public function getStats(){
        if(request()->isAjax() === false) return response()->redirect('/');
        $reseller = auth()->user();
        $creditSpent = \App\Models\Dashboard::getCreditSpent($reseller->id);
        $totalActivations = \App\Models\Dashboard::getActivatedDevices($reseller->id);
        $lastSevenDaysActivations = \App\Models\Dashboard::getActivatedDevices($reseller->id, "-7 days");
        $resellersCount = \App\Models\Dashboard::getResellersCount($reseller->id);
        response()->json([
            'credit_spent' => $creditSpent['total_credit'],
            'activated_devices' => $totalActivations['total_activated_devices'],
            'last_seven_days_activations' => $lastSevenDaysActivations['total_activated_devices'],
            'resellers_count' => $resellersCount['total_resellers']
        ]);
    }
}
