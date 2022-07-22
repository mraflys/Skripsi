<?php

namespace App\Model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FaceDataset extends Model
{
    use Uuid;
    use SoftDeletes;
    protected $table = 'face_datasets';
    protected $fillable = ['id_user','url_path','file_name','file_mime','python_folder'];
}
