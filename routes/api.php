<?php

Route::get('/test', function () {
    return auth()->user()->id;
});
