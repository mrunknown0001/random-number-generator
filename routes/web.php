<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/all/winners', 'WinnerController@winners_page')->name('winners.page');


Route::get('/check-number/{number}', 'WinnerController@check_number');


Route::get('/save-number/{number}', 'WinnerController@save_number');


Route::get('/add-winner/{id}/{winner}', 'WinnerController@add_winner');


Route::get('/add-prize/{id}/{prize}', 'WinnerController@add_prize');


Route::get('/winners', 'WinnerController@get_winners')->name('winners');