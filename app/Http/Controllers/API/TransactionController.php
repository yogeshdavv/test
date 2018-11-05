<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {
    public function index(Request $request) {
        $query = '
            SELECT _type, id, space_id, happened_on, description, amount
            FROM (
                SELECT "earning" AS _type, space_id, id, happened_on, description, amount FROM earnings
                UNION ALL
                SELECT "spending" AS _type, space_id, id, happened_on, description, amount FROM spendings
            ) a
            WHERE space_id = ?
            ORDER BY happened_on DESC
        ';

        // Filters
        if ($limit = $request->get('limit')) {
            $query .= ' LIMIT ' . $limit;
        }

        // Close
        $query .= ';';

        return DB::select($query, [session('space')->id]);
    }
}
