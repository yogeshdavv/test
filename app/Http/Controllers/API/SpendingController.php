<?php

namespace App\Http\Controllers\API;

use App\Spending;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpendingController extends Controller {
    public function create(Request $request) {
        // TODO VALIDATE

        $spending = Spending::create([
            'space_id' => session('space')->id,
            'happened_on' => $request->happened_on,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        return [
            'success' => true,
            'spending' => $spending
        ];
    }
}
