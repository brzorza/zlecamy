<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\OfferCategory;

class OfferCatalogController extends Controller
{
    public function index($categorySlug){

        $category = OfferCategory::where('slug', $categorySlug)->first();

        $title = $category->name;

        if(!$category){
            return redirect('/')->with('error','Nie ma takiej kategorii');
        }
        
        $offers = $category->offers()->with('user')->orderBy('created_at','desc')->paginate(16);
        $offers->each(function ($offer){
            $offer->all_tags = explode(',', $offer->all_tags);
        });

        return view('catalog.index', compact('offers', 'title'));
    }

    public function showSingle($id){

        $offer = Offer::with('user')->findOrFail($id);

        return view('catalog.offer-page', compact('offer'));
    }
}
