<?php

namespace App\Model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Absent extends Model
{
    use Uuid;
    use SoftDeletes;
    protected $table = 'absent';
    protected $fillable = ['id_user','url_path','file_name','file_mime','latitude','longitude','recognized','status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
