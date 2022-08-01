<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Model\Absent;
use app\User;
use Carbon\Carbon;
use Auth;

class UserList implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = User::select('name','email','username','role','is_active')->get();
        foreach ($datas as $data) {
            if($data->is_active == false){
                $data->is_active = 'Belum Aktif';
            }else{
                $data->is_active = 'Sudah Aktif';
            }
        }
        return collect($datas);
    }

    public function headings(): array {
        return [
            'name','email','username','role','user aktif'
        ];
    }
}
