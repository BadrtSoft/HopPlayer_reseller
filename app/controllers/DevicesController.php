<?php

namespace App\Controllers;

use App\Models\Device;

class DevicesController extends Controller
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
        // response()->json(Device::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        /*
        |--------------------------------------------------------------------------
        |
        | This is an example which deletes a particular row. 
        | You can un-comment it to use this example
        |
        */
        // $row = new Device;
        // $row->column = request()->get('column');
        // $row->delete();
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
        // $row = Device::find($id);
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
        // $row = Device::find($id);
        // $row->delete();
    }

    public function info() {
        return view('device_info', [
            'title' => 'Device Info',
            'activePage' => 'device_info',
            'durations' => [],
            // 'durations' => ActivationsController::$durations,
            // 'reseller' => auth()->user(),
            // '_token' => Token::generate("activate_device")
        ]);
    }

    public function infoPost() {
        $mac = request()->body()["device_mac"] ?? null;
        if(!$mac) return response()->json(['success' => false,'error' => 'Device MAC address is required'], 200);

        $device = Device::findByMac($mac, 'SQL_CACHE id, mac_address');
        // die(var_dump($device));
        if(!$device) return response()->json(['success' => false, 'error' => 'Device not found'], 200);
        // var_dump($device);
        return response()->json(['success' => true, 'device_id' => $device['id']], 200);
    }
}
