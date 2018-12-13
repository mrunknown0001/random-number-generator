<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/check-number', 'WinnerController@check_number');


Route::get('/save-number/{number}', 'WinnerController@save_number');


Route::get('/add-winner/{winner}', 'WinnerController@add_winner');


Route::get('/add-prize/{prize}', 'WinnerController@add_prize');


Route::get('/winners', 'WinnerController@get_winners');