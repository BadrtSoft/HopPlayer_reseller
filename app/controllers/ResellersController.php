<?php

namespace App\Controllers;

use App\Models\Log;

class ResellersController extends Controller
{
    public function index()
    {
        response()->render('resellers.manage', [
            'page_title' => 'Resellers',
            'reseller' => auth()->user()
        ]);
    }

    public function manage(){
        response()->render('resellers.manage', [
            'page_title' => 'Resellers',
            'reseller' => auth()->user()
        ]);
    }

    public function create(){
        response()->render('resellers.create', [
            'page_title' => 'Create Reseller',
            'reseller' => auth()->user()
        ]);
    }

    public function store(){
        $body = request()->body();
        if(!$body['username'] || !$body['password'] || !$body['credits'] || !is_numeric($body['credits']) || empty($body["username"]) || empty($body["password"]) || empty($body["credits"])){
            return response()->json([
                'success' => false,
                'message' => 'All fields are required and credits must be a number'
            ]);
        }

        if($body['credits'] > auth()->user()->credits){
            return response()->json([
                'success' => false,
                'message' => 'You do not have enough credits'
            ]);
        }

        if($body['credits'] <= 0){
            return response()->json([
                'success' => false,
                'message' => 'Credits must be a positive number greater than zero'
            ]);
        }

        if(\App\Models\Reseller::findByUsername($body['username'])){
            return response()->json([
                'success' => false,
                'message' => 'Username already exists'
            ]);
        }
        $reseller = auth()->user();
        $updateCredits = auth()->update(['credits' => auth()->user()->credits - $body['credits']]);
        if(!$updateCredits){
            return response()->json([
                'success' => false,
                'message' => 'Failed to update your credits'
            ]);
        }

        Log::insertCreditsLog([
            'reseller_id' => $reseller->id,
            'reason' => 'create_reseller',
            'credit' => $body['credits'],
            'credits_before' => $reseller->credits + $body['credits'],
            'credits_after' => $reseller->credits,
            'description' => 'Created reseller '.$body['username'].' with '.$body['credits'].' credits',
            'action_date' => time()
        ]);

        \App\Models\Reseller::create([
            'username' => $body['username'],
            'password' => password_hash($body['password'], PASSWORD_BCRYPT),
            'credits' => $body['credits'],
            'owner_id' => auth()->user()->id,
            'created_at' => time()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reseller created successfully',
            'redirect' => '/resellers'
        ]);

    }

    public function dataTables(){
        $resellers = \App\Models\Reseller::findByOwner(auth()->user()->id);
        $data = [];
        foreach($resellers as $reseller){
            $data[] = [
                'id' => $reseller["id"],
                'username' => $reseller["username"],
                'credits' => $reseller["credits"],
                'created_at' => date('Y-m-d H:i:s', $reseller["created_at"]),
                'last_login' => $reseller["last_login"] ? date('Y-m-d H:i:s', $reseller["last_login"]) : 'Never',
                'action' => '<a href="/resellers/edit/'.$reseller["id"].'" class="btn btn-sm btn-primary">Edit</a> <form method="POST" action="/resellers/delete" style="display:inline;"><input type="hidden" name="reseller_id" value="'.$reseller["id"].'"><button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button></form>'
            ];
        }
        response()->json([
            'draw' => request()->params('draw'),
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ]);
    }
}