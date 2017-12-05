<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('ventasuser')->user();

    //dd($users);

    return view('ventasuser.home');
})->name('home');

