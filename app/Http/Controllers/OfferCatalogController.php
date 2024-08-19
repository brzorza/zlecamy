<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\OfferCategory;

class OfferCatalogController extends Controller
{
    public function index(Request $request){
        // dd($request->query('query'));

        $categorySlug = $request->category;

        $category = OfferCategory::where('slug', $categorySlug)->first();

        $title = $category->name;

        // Redirect home if no category was found
        if(!$category){
            return redirect('/')->with('error','Nie ma takiej kategorii');
        }
        

        // filters
        $offers = $category->offers();

        if($request->query('query')){
            $query = $request->query('query');
            $offers->where('title', 'like', '%' . $query . '%');
        }

        if($request->query('miejsce')){
            $query = $request->query('miejsce');
            $offers->where('localization', 'like', '%' . $query . '%');
        }

        if($request->query('cena_min')){
            $query = $request->query('cena_min');
            $offers->where('price', '>' , $query);
        }

        if($request->query('cena_max')){
            $query = $request->query('cena_max');
            $offers->where('price', '<' , $query);
        }

        if($request->query('sorttitle')){
            $query = $request->query('sorttitle');
            switch($query){
                case 'asc':
                    $offers->orderBy('title', 'asc');
                    break;
                case 'desc':
                    $offers->orderBy('title', 'desc');
                    break;
                default:
                    $offers->orderBy('title', 'asc');
                    break;
            }
        }
        

        if($request->query('sortprice')){
            $query = $request->query('sortprice');
            switch($query){
                case 'asc':
                    $offers->orderBy('price', 'asc');
                    break;
                case 'desc':
                    $offers->orderBy('price', 'desc');
                    break;
                default:
                    $offers->orderBy('price', 'asc');
                    break;
            }
        }

        // Get query
        $offers = $offers->with('user')->orderBy('created_at','desc')->paginate(16);

        return view('catalog.index', compact('offers', 'title'));
    }

    public function showSingle($id){

        $offer = Offer::with('user')->findOrFail($id);

        return view('catalog.offer-page', compact('offer'));
    }
}
