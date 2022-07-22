<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return $request->user();
    }

    public function index(Request $request)
    {
        return view('user.index');
    }

    public function datatable(Request $request)
    {
        $datas = User::get();
        return Datatables::of($datas)
            ->addColumn('action', function ($data) {
                $action = '';
                if($data->is_active == 0){
                    $action .= "<a href='". route('user-active',['id' => $data->id]) ."' class='btn btn-outline-success text-success' title='Aprove'><i class='feather icon-check-square'></i> Aktivkan User</a>";
                }else{
                    $action .= "<a href='". route('user-unactive',['id' => $data->id]) ."' class='btn btn-outline-danger text-danger' title='Reject'><i class='feather icon-x-square'></i> Matikan User</a>";
                }
                return $action;
            })->make(true);
    }

    public function active(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        $user->is_active = true;
        $user->save();
        return redirect()->back()->with('message_success', 'Berhasil Mengaktivkan User');
    }

    public function unactive(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        $user->is_active = false;
        $user->save();
        return redirect()->back()->with('message_success', 'Berhasil Menonaktivkan User');
    }
}
