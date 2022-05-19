<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{

    public function store(Request $request)
    {
        return response()
            ->json([
                'success' => true,
                'data' => "suksess"
            ]);
    }
}
