<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Enums\PriceTypeEnum;
use Illuminate\Http\Request;
use App\Models\OfferCategory;

class OfferController extends Controller
{
    public function create(){

        $categories = OfferCategory::all();

        return view('offers.create', [
            'categories'=> $categories
        ]);
    }

    public function store(Request $request){
        
        $formfields = $request->validate([
            'title'=> 'required|string',
            'description'=> 'required|string',
            'localization'=> 'required|string',
            'category_id'=> 'required|string',
            'all_tags'=> 'string',
            'cover'=> 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'price'=> 'required|integer',
            'price_type' => ['required', 'string', 'in:' . implode(',', array_column(PriceTypeEnum::getValues(), 'value'))],
            'delivery_time' => 'required|string|max:50',
        ]);

        $formfields['user_id'] = auth()->id();

        // TODO convert to webp
        if($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imagePath = $image->store('images/offerCovers', 'public');
            $formfields['cover'] = $imagePath;
        }else{
            // TODO add default
            $formfields['cover'] = 'images/offerCovers/1W2dV4ZMkQrIoDXYB3T645GyOnNzJrvj27f7UU64.webp';
        }

        $offer = Offer::create($formfields);

        return redirect()->route('profile.offers')->with('success','Ofeta została dodana');
    }

    public function destroy($id){
        
        $offer = Offer::findOrFail($id);

        if($offer->user_id == auth()->id()){
            $offer->delete();
            return redirect()->back()->with('success', 'Oferta została usunięta.');
        }else{
            abort(403, 'Brak dostępu');
        }
    }
}