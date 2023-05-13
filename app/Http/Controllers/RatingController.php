<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        Rating::create([
            'location_object_id' => $id,
            'user_id' => auth()->user()->id,
            'score' => $request->score,
            'comment' => '-',
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rating = Rating::query()
            ->where('location_object_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        $rating->update([
            'score' => $request->score,
            'comment' => '-',
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $rating = Rating::query()
            ->where('location_object_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        $rating->delete();
        return redirect()->back();
    }
}
