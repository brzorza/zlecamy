<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class NewsletterController extends Controller
{
    public function addUser(Request $request){

        $formfields = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
        ]);

        if(isset(auth()->user()->username)){
            $formfields['username'] = auth()->user()->username;
        }

        Newsletter::create($formfields);

        return back()->with('success', 'Dziękujemy za zapisanie się na nasz newsletter!');
    }
}
