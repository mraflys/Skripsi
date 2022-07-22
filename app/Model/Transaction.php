<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
class Transaction extends Model
{
    use SoftDeletes;
    protected $table = 'transactions';
    protected $fillable = ['id','id_transactions','city','area','code_area','nominal','description','reviewed_status','reviewed_at','reviewed_by','request_By','url_path','file_name','file_mime'];

    public function request_name()
    {
        return $this->belongsTo(User::class, 'request_By', 'id');
    }
    public function reviewed_name()
    {
        return $this->belongsTo(User::class, 'reviewed_by', 'id');
    }
}
