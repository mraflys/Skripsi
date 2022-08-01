<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Model\Absent;
use Carbon\Carbon;
use Auth;
class PeriodeAbsen implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(\Auth::user()->role == 'administrator'){
            $Absents = Absent::select(Absent::raw('DATE(created_at) as date'), Absent::raw('count(*) as periode'))->groupBy('date')->get();

            return collect($Absents);
        }else{
            $Absents = Absent::where('id_user',Auth::user()->id)->with('user')->select('id_user','latitude','longitude','status')->get();
            foreach($Absents as $Absent){
                $Absent->name = $Absent->user->name;
                $Absent->tanggal = Carbon::parse($Absent->created_at)->format("d-m-Y");
                $Absent->jam = Carbon::parse($Absent->created_at)->format("H:s");
                if($Absent->status == 1){
                    $Absent->status = 'Berhasil';
                }else{
                    $Absent->status = 'Tidak Berhasil';
                }
                
            }
            return collect($Absents);
        }
        
    }

    public function headings(): array {
        if(\Auth::user()->role == 'administrator'){
            return [
                'tanggal','periode user lapangan'
            ];
        }else{
            return [
                'id_user','latitude','longitude','status','name','tanggal','jam'
            ];
        }

    }
}
