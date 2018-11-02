<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EarningController extends Controller {
    public function index() {
        $space = auth()->user()->spaces[0];

        return $space->earnings()->orderBy('happened_on', 'DESC')->get();
    }
}
