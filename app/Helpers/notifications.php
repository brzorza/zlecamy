<?php

use App\Models\Notifications;

if (!function_exists('addNewNotification')) {
    function addNewNotification($user_id, $message, $link) {

        $data = [
            'user_id' => $user_id,
            'message' => $message,
            'link' => $link,
            'read' => 0,
        ];

        Notifications::create($data);
        // TODO add all Notification
    }
}
