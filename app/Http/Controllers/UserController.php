<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\LanguageProficiency;
use App\Models\User;
use App\Models\Offer;
use App\Models\UserLanguage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        
        //Add user type
        $formfields['type'] = isset($request->type) ? 'seller' : 'user';
        
        // Create user
        $user = User::create($formfields);
        
        //Login Created User
        auth()->login($user);

        return redirect('/profile')->with('success', 'Konto zostało stworzone!');
    }

    public function authenticate(Request $request){
        $formfields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(Auth::attempt($formfields)){
            $request->session()->regenerate();

            return redirect('/profile')->with('success', 'Zostałeś zalogowany!');
        }else{
            return back()->withErrors(['email'=>'Niepoprawne dane'])->onlyInput();
        }
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Zostałeś wylogowany!');
    }

    // Edit your profile
    public function show(){

        $user = User::where('id', auth()->id())->firstOrFail();

        return view('users.index', compact('user'));
    }

    public function showEdit(){

        $user = User::where('id', auth()->id())->with(['userLanguages.language', 'userLanguages.proficiency'])->firstOrFail();
        $languages = Language::all();
        $languages_proficiency = LanguageProficiency::all();

        return view('users.edit', compact('user', 'languages', 'languages_proficiency'));
    }

    public function edit(Request $request){

        $user = User::where('id', auth()->id())->with('userLanguages')->firstOrFail();

        $formfields = $request->validate([
            'profile_picture'=> 'image|mimes:jpeg,png,jpg,webp|max:20048',
            'username' => 'required|min:3',
            'name' => 'string|nullable',
            'surname' => 'string|nullable',
        ]);

        $languageInfo = $request->validate([
            'language_id' => 'integer|nullable',
            'proficiency_id' => 'integer|nullable',
        ]);

        // see if user can add language
        $can_add_language = true;

        foreach($user->userLanguages as $id){
            if($id->language_id == $languageInfo['language_id']){
                $can_add_language = false;
            }
        }
        
        // add language and its proficiency
        if(!empty($languageInfo['language_id']) && !empty($languageInfo['proficiency_id'])){
            $user->userLanguages()->create([
                'language_id' => $languageInfo['language_id'],
                'proficiency_id' => $languageInfo['proficiency_id'],
            ]);
        }

        // See if image is beeing changed, delete previous and add new
        if($request->hasFile('profile_picture')) {
            // prevent deleting default image and delete current
            if ($user->profile_picture != 'images/profile_pictures/no-image.jpg') {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // add new
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
