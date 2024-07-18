<?php

namespace App\Http\Controllers;

use App\Models\OfferCategory;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    function index(){

        $categories = OfferCategory::all();

        return view('welcome', compact('categories'));
    }
}
