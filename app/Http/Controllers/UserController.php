<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        return view('users.login');
    }

    public function store(Request $request){

        $formfields = $request->validate([
            'username' => ['required', 'min:3', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:8'
        ]);
        
        // Hash Password
        $formfields['password'] = bcrypt($formfields['password']);
        
        // Creare
        // dd($formfields);
        $user = User::create($formfields);
        //Login Created User
        auth()->login($user);

        return redirect('/profile')->with('success', 'User created and logged in!');
    }

    public function authenticate(Request $request){
        $formfields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formfields)){
            $request->session()->regenerate();

            return redirect('/profile')->with('success', 'You have logged id!');
        }else{
            return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput();
        }
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out!');
    }

    // Edit your profile
    public function show(){

        $user = User::where('id', auth()->id())->firstOrFail();

        return view('users.index', compact('user'));
    }

    public function showEdit(){

        $user = User::where('id', auth()->id())->firstOrFail();

        return view('users.edit', compact('user'));
    }
    public function edit(Request $request){

        $user = User::where('id', auth()->id())->firstOrFail();

        $formfields = $request->validate([
            'profile_picture'=> 'image|mimes:jpeg,png,jpg,webp|max:20048',
            'username' => 'required|min:3',
            'name' => 'string|nullable',
            'surname' => 'string|nullable',
        ]);

        // See if image is beeing changed, delete previous and add new
        if($request->hasFile('profile_picture')) {
            if ($user->profile_picture != 'images/profile_pictures/no-image.jpg') {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $image = $request->file('profile_picture');
            $imagePath = $image->store('images/profile_pictures', 'public');
            $formfields['profile_picture'] = $imagePath;
        }


        // update user info
        if(!empty($formfields['profile_picture'])){
            $user->profile_picture = $formfields['profile_picture'];
        }
        $user->username = $formfields['username'];
        $user->name = $formfields['name'];
        $user->surname = $formfields['surname'];
        $user->save();

        return redirect('/profile')->with('success', 'Profil został zaktalizowany!');
    }
    public function offers(){

        $userId = auth()->id();

        $allOffers = Offer::where('visible',1)->where('user_id', $userId)->get();

        return view('users.offers', compact('allOffers'));
    }
}
