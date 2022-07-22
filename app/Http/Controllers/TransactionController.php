<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Model\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class TransactionController extends Controller
{
    public function index(Request $request)
    {   
        // dd(Session::get('message_success'));
        return view('transactions.transactions');
    }
    public function new()
    {
        return view('transactions.transaction-new');
    }

    public function datatable(Request $request)
    {
        $datas = Transaction::with('request_name')->whereNull('reviewed_at')->orderBy('created_at', 'Desc')->get();
        return Datatables::of($datas)
            ->editColumn('request_By', function($data) {
                
                return $data->request_name->name;
            })
            ->addColumn('action', function ($data) {
                $action = "<a href='' class='btn btn-outline-success text-success' title='Aprove'><i class='feather icon-check-square'></i> Aprove</a> | ";
                $action .= "<a href='". route('transactions.reject', [$data->id]) ."' class='btn btn-outline-danger text-danger' title='Reject'><i class='feather icon-x-square'></i> Reject</a>";
                return $action;
            })->make(true);
    }

    public function datatablehistory(Request $request)
    {
        $datas = Transaction::with('request_name','reviewed_name')->whereNotNull('reviewed_at')->orderBy('created_at', 'Desc')->get();
        return Datatables::of($datas)
            ->editColumn('request_By', function($data) {
                
                return $data->request_name->name;
            })
            ->editColumn('reviewed_by', function($data) {
                
                return $data->reviewed_name->name;
            })
            ->editColumn('reviewed_at', function($data) {
                
                return Carbon::createFromFormat('Y-m-d H:i:s', $data->reviewed_at)->format('d-M-Y');
            })->make(true);
    }

    public function reject(Request $request)
    {
        $transaction = Transaction::where('id',$request->id)->first();
        $id_transaction = $transaction->id_transactions;
        DB::beginTransaction();
        try {
            $transaction->delete();
            DB::commit();
            Session::flash('message_reject', "Transaction ".$id_transaction." has been rejected");
            
        }catch (\Exception $e) {
            DB::rollback();
        }
        
        return redirect(route('transactions.index'));
    }
}
