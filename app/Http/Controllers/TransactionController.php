<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\Transaction;


class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.transactions');
    }
    public function new()
    {
        return view('transactions.transaction-new');
    }

    public function datatable(Request $request)
    {
        $datas = Transaction::whereNull('reviewed_at')->orderBy('created_at', 'Desc')->get();
        return Datatables::of($datas)
            ->addColumn('action', function ($posts) {
                $action = "<a href='' class='btn btn-outline-success text-success' title='Aprove'><i class='feather icon-check-square'></i> Aprove</a> | ";
                $action .= "<a href='' class='btn btn-outline-danger text-danger' title='Reject'><i class='feather icon-x-square'></i> Reject</a>";
                return $action;
            })->make(true);
    }
}
