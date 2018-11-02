<?php

namespace App\Http\Controllers\API;

use App\Earning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EarningController extends Controller {
    public function index() {
        $space = auth()->user()->spaces[0];

        return $space->earnings()->orderBy('happened_on', 'DESC')->get();
    }

    public function create(Request $request) {
        // TODO VALIDATE

        $earning = Earning::create([
            'space_id' => session('space')->id,
            'happened_on' => $request->happened_on,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        return [
            'success' => true,
            'earning' => $earning
        ];
    }
}
