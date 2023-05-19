<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;

class RatingController extends Controller
{
    public function index()
    {
        //
    }
    
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
    
    public function update(Request $request, $id)
    {
        $rating = Rating::query()
            ->where('location_object_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();
        // dd($request, $id, auth()->user()->id, $rating);
        $rating->update([
            'score' => $request->score,
            'comment' => '-',
        ]);
        return redirect()->back();
    }
    
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
