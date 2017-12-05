<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('facturacionuser')->user();

    //dd($users);

    return view('facturacionuser.home');
})->name('home');

