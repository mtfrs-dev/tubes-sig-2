<?php

namespace App\Http\Controllers;

use App\Models\LocationObject;
use App\Http\Requests\StoreLocationObjectRequest;
use App\Http\Requests\UpdateLocationObjectRequest;

class LocationObjectController extends Controller
{
    public function index()
    {
        return view('pages.admin-index');
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationObjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationObject $locationObject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocationObject $locationObject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationObjectRequest $request, LocationObject $locationObject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationObject $locationObject)
    {
        //
    }
}
