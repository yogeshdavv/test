<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {
    public function index(Request $request) {
        $query = '
            SELECT type, id, space_id, happened_on, description, amount, created_at
            FROM (
                SELECT "earning" AS type, space_id, id, happened_on, description, amount, created_at FROM earnings
                UNION ALL
                SELECT "spending" AS type, space_id, id, happened_on, description, amount, created_at FROM spendings
            ) a
            WHERE space_id = ?
            ORDER BY happened_on DESC, created_at DESC
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
