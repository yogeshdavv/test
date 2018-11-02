<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {
    public function index() {
        return DB::select('
            SELECT _type, id, happened_on, description
            FROM (
                SELECT "earning" AS _type, id, happened_on, description FROM earnings
                UNION ALL
                SELECT "spending" AS _type, id, happened_on, description FROM spendings
            ) a
            ORDER BY happened_on DESC;
        ');
    }
}
