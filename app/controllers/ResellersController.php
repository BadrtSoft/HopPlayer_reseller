<?php

namespace App\Controllers;

use App\Models\Log;

class ResellersController extends Controller
{
    public function index() {
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
            'reseller' => auth()->user(),
            '_token' => \Lib\Token::generate('create_reseller_form')
        ]);
    }

    public function store(){
        if(request()->isAjax() === false) return response()->redirect('/resellers/create');
        $body = request()->body();

        if(!\Lib\Token::check($body['_token'] ?? '', 'create_reseller_form')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid CSRF token'
            ]);
        }

        if(!$body['username'] || !$body['password'] || !$body['credits'] || !is_numeric($body['credits']) || empty($body["username"]) || empty($body["password"]) || empty($body["credits"])){
            return response()->json([
                'success' => false,
                'message' => 'All fields are required and credits must be a number',
                '_token' => \Lib\Token::generate('create_reseller_form')
            ]);
        }

        if($body['credits'] > auth()->user()->credits){
            return response()->json([
                'success' => false,
                'message' => 'You do not have enough credits',
                '_token' => \Lib\Token::generate('create_reseller_form')
            ]);
        }

        if($body['credits'] <= 0){
            return response()->json([
                'success' => false,
                'message' => 'Credits must be a positive number greater than zero',
                '_token' => \Lib\Token::generate('create_reseller_form')
            ]);
        }
        
        if(\App\Models\Reseller::findByUsername($body['username'])){
            return response()->json([
                'success' => false,
                'message' => 'Username already exists',
                '_token' => \Lib\Token::generate('create_reseller_form')
            ]);
        }
        $reseller = auth()->user();
        $updateCredits = auth()->update(['credits' => auth()->user()->credits - $body['credits']]);
        if(!$updateCredits){
            return response()->json([
                'success' => false,
                'message' => 'Failed to update your credits',
                '_token' => \Lib\Token::generate('create_reseller_form')
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
            '_token' => \Lib\Token::generate('create_reseller_form')
        ]);

    }

    public function dataTables(){
        if(request()->isAjax() === false) return response()->redirect('/');
        $resellers = \App\Models\Reseller::allByOwner(auth()->user()->id);
        $data = [];
        foreach($resellers as $reseller){
            $data[] = [
                'id' => $reseller["id"],
                'username' => $reseller["username"],
                'credits' => $reseller["credits"],
                'created_at' => date('Y-m-d H:i:s', $reseller["created_at"]),
                'last_login' => $reseller["last_login"] ? date('Y-m-d H:i:s', $reseller["last_login"]) : 'Never',
                'action' => '<a href="/resellers/edit/'.$reseller["id"].'" class="btn btn-sm btn-primary">Edit</a> <button type="submit" class="btn btn-sm btn-danger" onclick="return window.delete('.$reseller["id"].')">Delete</button>'
            ];
        }
        response()->json([
            'draw' => request()->params('draw'),
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ]);
    }

    public function destroy(){
        if(request()->isAjax() === false) return response()->redirect('/');
        $body = request()->body();
        if(!$body['reseller_id'] || !is_numeric($body['reseller_id']) || empty($body['reseller_id'])){
            return response()->redirect('/resellers');
        }
        $reseller = \App\Models\Reseller::findById($body['reseller_id']);
        // die(var_dump($reseller));
        if(!$reseller || $reseller["owner_id"] != auth()->user()->id) return response()->json(['success' => false, 'message' => 'Reseller not found']);
        $deleted = \App\Models\Reseller::remove($body['reseller_id']);
        if($deleted){
            return response()->json(['success' => true, 'message' => 'Reseller deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete reseller']);
    }
}