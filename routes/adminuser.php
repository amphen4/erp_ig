<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('adminuser')->user();

    //dd($users);

    return view('adminuser.home');
})->name('home');

