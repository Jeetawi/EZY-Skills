<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Private channel for teacher notifications
Broadcast::channel('teacher.{teacherId}', function ($user, $teacherId) {
    return (int) $user->id === (int) $teacherId && $user->hasRole('teacher');
});
