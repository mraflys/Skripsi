<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Model\Absent;
use Carbon\Carbon;

class UserAbsent implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Absents = Absent::with('user')->select('id_user','latitude','longitude','status')->orderBy('created_at','asc')->get();
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

    public function headings(): array {
        return [
            'id_user','latitude','longitude','status','name','tanggal','jam'
        ];
    }
}
