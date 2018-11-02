<?php

Route::get('/transactions', 'API\TransactionController@index');

Route::get('/earnings', 'API\EarningController@index');
