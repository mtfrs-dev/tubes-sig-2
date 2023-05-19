<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\LocationObject;
use Illuminate\Support\Facades\DB;

class OlahragaController extends Controller
{
    public function index(Request $request){
        $object_type    = 'sarana olahraga';
        $search_key     = $request['search'];
        $sortby         = $request['sortby'];
        $mylatitude     = $request['mylatitude'];
        $mylongitude    = $request['mylongitude'];

        if(isset($search_key) && isset($sortby)){
            if($sortby == 'rating'){
                $preOrderedData = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
                    ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
                    ->where('type', 'Sarana Olahraga')
                    ->where(function($query) use ($search_key){
                        $query->where('name', 'ilike', '%'.$search_key.'%')
                        ->orWhere('address', 'ilike', '%'.$search_key.'%');
                    })
                    ->groupBy('location_objects.id')
                    ->get();
                $data = $preOrderedData->sortByDesc('rating');
            } else {
                $preOrderedData = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
                    ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
                    ->where('type', 'Sarana Olahraga')
                    ->where(function($query) use ($search_key){
                        $query->where('name', 'ilike', '%'.$search_key.'%')
                        ->orWhere('address', 'ilike', '%'.$search_key.'%');
                    })
                    ->selectRaw("ST_Distance(ST_MakePoint($mylatitude, $mylongitude), location_objects.geometry) as distance")
                    ->groupBy('location_objects.id')
                    ->get();
                $data = $preOrderedData->sortBy('distance');
            }
        } else if (isset($search_key)){
            $data = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
                ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
                ->where('type', 'Sarana Olahraga')
                ->where(function($query) use ($search_key){
                    $query->where('name', 'ilike', '%'.$search_key.'%')
                    ->orWhere('address', 'ilike', '%'.$search_key.'%');
                })
                ->groupBy('location_objects.id')
                ->get();
        } else if (isset($sortby)) {
            if($sortby == 'rating'){
                $preOrderedData = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
                    ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
                    ->where('type', 'Sarana Olahraga')
                    ->groupBy('location_objects.id')
                    ->get();
                $data = $preOrderedData->sortByDesc('rating');
            } else {
                $preOrderedData = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
                    ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
                    ->where('type', 'Sarana Olahraga')
                    ->selectRaw("ST_Distance(ST_MakePoint($mylatitude, $mylongitude), location_objects.geometry) as distance")
                    ->groupBy('location_objects.id')
                    ->get();
                $data = $preOrderedData->sortBy('distance');
            }
        } else {
            $data = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
                ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
                ->where('type', 'Sarana Olahraga')
                ->groupBy('location_objects.id')
                ->get();
        }
        return view("pages.index", compact('data','object_type', 'search_key', 'sortby', 'mylatitude', 'mylongitude'));
    }

    public function show($id){
        $object_type = 'sarana olahraga';

        $data = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
            ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
            ->where('type', 'Sarana Olahraga')
            ->groupBy('location_objects.id')
            ->where('location_objects.id', $id)
            ->first();
            
        $myRating = Rating::query()
            ->where('location_object_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        $recommendations = LocationObject::leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
            ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
            ->where('type', 'Sarana Olahraga')
            ->groupBy('location_objects.id')
            ->whereNot('location_objects.id', $id)
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();
            
        return view("pages.detail", compact('object_type', 'data', 'recommendations', 'myRating'));
    }
}
