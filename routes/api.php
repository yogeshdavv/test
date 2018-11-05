<?php

Route::get('/transactions', 'API\TransactionController@index');

Route::post('/earnings', 'API\EarningController@create');

Route::post('/spendings', 'API\SpendingController@create');
