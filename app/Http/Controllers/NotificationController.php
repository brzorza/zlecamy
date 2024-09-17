<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){

        // $notifications = Notifications::

        return view('notifications');
    }

    public function readNotification($id){

        $notification = Notifications::findOrFail($id);

        if($notification->user_id == auth()->id()){
            $notification->read = 1;
            $notification->save();

            return response()->json([
                'data' => 'ok'
            ]);
        }


    } 
}
