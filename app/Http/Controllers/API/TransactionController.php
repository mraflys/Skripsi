<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Model\Transaction;

class TransactionController extends Controller
{

    public function store(Request $request)
    {
        //move file
        $path = public_path('storage/' . date("n"));

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = rand(100000, 999999) . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        $fullPath = 'storage/'.date("n").'/'.$name;

        //get transactions count in a day
        $trCount = Transaction::whereDate('created_at',date("Y-m-d"))->count();
        $trCount = $trCount + 1;

        $trCount = str_pad($trCount, 4, "0", STR_PAD_LEFT);
        $idTransactions = $request->code_area . date("dmY") . $trCount;

        Transaction::Create([
            'id_transactions' => $idTransactions,
            'city' => $request->city,
            'area' => $request->area,
            'code_area' => $request->code_area,
            'nominal' => $request->nominal,
            'description' => $request->description,
            'request_By' => $request->request_By,
            'url_path' => $fullPath,
            'file_name' => \File::name(public_path($fullPath)),
            'file_mime' => \File::mimeType(public_path($fullPath)),
        ]);

        return response()
            ->json([
                'status' => 'success'
            ]);
    }
}
