<?php

namespace App\Controllers;

class ResellersController extends Controller
{
    public function index()
    {
        response()->render('reseller');
    }
}
