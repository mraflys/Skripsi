<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['id','id_transactions','city','area','code_area','nominal','description','reviewed_status','reviewed_at','reviewed_by','request_By','url_path','file_name','file_mime'];
}
