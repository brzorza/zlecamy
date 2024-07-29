<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;

class UsersBrowseController extends Controller
{
    public function show($username){

        $user = User::where('username', $username)->first();
    
        return view('browse_users.index', compact('user'));

    }

    public function offers($username){

        // $userId = auth()->id();

        // $allOffers = Offer::where('visible',1)->where('user_id', $userId)->get();

        $user = User::where('username', $username)
        ->with(['offers' => function($query){
            $query->where('visible', 1);
        }])
        ->firstOrFail();

        return view('browse_users.offers', compact('user'));
    }

    public function opinions($username){

        $user = User::where('username', $username)->firstOrFail();
        
        return view('browse_users.opinions', compact('user'));
    }
}
