<?php

namespace App\Controllers;

use App\Models\Playlist;
use App\Models\Device;
use Lib\Token;
class PlaylistsController extends Controller
{    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which retrieves all the data (rows)
        | from our model. You can un-comment it to use this
        | example
        |
        */
        // response()->json(Playlist::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
        render('playlists.create', [
            'page_name' => 'Add Playlist',
            'description' => 'Add a new playlist to your devices.',
            'reseller' => auth()->user(),
            '_token' => Token::generate("add_playlist")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeXtremeCodes() {
        if(request()->isAjax() === false) return response()->redirect('/');
        if(!Token::check(request()->body()['_token'] ?? '', "add_playlist")) {
            return response()->json(['success' => false, 'error' => 'Invalid CSRF token'], 200);
        }
        $data = request()->body();
        $result = Playlist::addFromXtreamCodes([
            "device_id" => $data['device_id'] ?? null,
            "name" => $data['playlist_name'] ?? null,
            "protocol" => $data['protocol'] ?? "http",
            "hostname" => $data['hostname'] ?? null,
            "port" => $data['port'] ?? null,
            "username" => $data['username'] ?? null,
            "password" => $data['password'] ?? null,
        ]);
        return response()->json(["success" => true, "data" => $result, "_token" => Token::generate("add_playlist")], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUrl() {
        if(request()->isAjax() === false) return response()->redirect('/');
        if(!Token::check(request()->body()['_token'] ?? '', "add_playlist")) {
            return response()->json(['success' => false, 'error' => 'Invalid CSRF token'], 200);
        }
        $data = request()->body();

        $result = Playlist::addFromUrl([
            "device_id" => $data['device_id'] ?? null,
            "name" => $data['playlist_name'] ?? null,
            "url" => $data['playlist_url'] ?? null,
        ]);
        return response()->json(["success" => true, "data" => $result, "_token" => Token::generate("add_playlist")], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which edits a particular row. 
        | You can un-comment it to use this example
        |
        */
        // $row = Playlist::find($id);
        // $row->column = request()->get('column');
        // $row->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which deletes a particular row. 
        | You can un-comment it to use this example
        |
        */
        // $row = Playlist::find($id);
        // $row->delete();
    }

    public function deviceInfo() {
        if(request()->isAjax() === false) return response()->redirect('/');
        if(!Token::check(request()->body()['_token'] ?? '', "add_playlist")) {
            return response()->json(['success' => false, 'error' => 'Invalid CSRF token'], 200);
        }
        $mac = request()->body()["device_mac"] ?? null;
        if(!$mac) return response()->json(['success' => false,'error' => 'Device MAC address is required', '_token' => Token::generate("add_playlist")], 200);

        $device = Device::findByMac($mac, 'SQL_CACHE id, mac_address');
        // die(var_dump($device));
        if(!$device) return response()->json(['success' => false, 'error' => 'Device not found', '_token' => Token::generate("add_playlist")], 200);
        // var_dump($device);
        return response()->json(['success' => true, 'device_id' => $device['id'], '_token' => Token::generate("add_playlist")], 200);
    }

}
