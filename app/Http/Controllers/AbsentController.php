<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Storage;
use App\Model\FaceDataset;
use App\Model\Absent;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Mapper;

class AbsentController extends Controller
{
    public function index(Request $request)
    {
        $faceDataset = FaceDataset::where('id_user', $request->id)->get();
        $id = $request->id;
        if(count($faceDataset) < 5){
            return view('absent.dataset-absent', compact('faceDataset','id'));
        }else{
            return redirect(route('home'));
        }
    }

    public function webcam_store(Request $request)
    {

        $img = $request->image;
        $folderPath = "dataset/".$request->id.'/';
        
        $path = storage_path('app/public/'.$folderPath);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $facedataCount = FaceDataset::where('id_user', $request->id)->get();
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = count($facedataCount) + 1 . '_' . $request->id . '.jpg';
        
        $file = $folderPath . $fileName;

        $fullpath = \Storage::disk('public')->put($file, $image_base64);
        
        
        
        // $response = Http::post('http://192.168.0.100:5000/api/save_image');
        if(count($facedataCount) != 0){
            $form_data = [
                'folder' => $facedataCount[0]->python_folder,
            ];
        }else{
            $form_data = [
                'sdada' => null,
            ];
        }
        

        $response = Http::attach(
            'file', file_get_contents(\Storage::disk('public')->path('').$file, True), $fileName
        )->post('http://127.0.0.1:5000/api/save_image',$form_data);

        $FaceDataset = FaceDataset::create([
            'id_user' => $request->id,
            'url_path' => $folderPath,
            'file_name' => $fileName,
            'python_folder' => $response['pythonDirektory'],
            'file_mime' => \File::mimeType(storage_path('app/public/' . $file)),
        ]);
        
        if(count($facedataCount) < 5){
            return redirect(route('absent-index', ['id' => $request->id]));
        }else{
            return redirect(route('login.auth'));
        }
        
    }

    public function absent_index(Request $request){
        
        return view('absent.absent');
    }

    public function absent_store(Request $request)
    {

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $img = $request->image;
        $folderPath = "absent/";
        
        $path = storage_path('app/public/'.$folderPath);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = 'Absent_' . Auth::user()->id . date("dmYs") . '.jpg';
        
        $file = $folderPath . $fileName;

        $fullpath = \Storage::disk('public')->put($file, $image_base64);
        

        $response = Http::attach(
            'absent', file_get_contents(\Storage::disk('public')->path('').$file, True), $fileName
        )->post('http://127.0.0.1:5000/api/eigenface');

        if($response['message'] == 'Success'){
            $indexname = str_replace("/","",$response['indexname']);
            $FaceDataset = FaceDataset::where('python_folder', 'like', '%'.$indexname.'%')->first();
            if($FaceDataset->id_user == Auth::user()->id){
                $Absent = Absent::create([
                    'id_user' => Auth::user()->id,
                    'url_path' => $folderPath,
                    'file_name' => $fileName,
                    'file_mime' => \File::mimeType(storage_path('app/public/' . $file)),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'recognized' => true,
                    'status' => true,
                ]);
                return redirect(route('absent-face'))->with('success', 'Anda Telah Berhasil Absent!');
            }else{
                $Absent = Absent::create([
                    'id_user' => Auth::user()->id,
                    'url_path' => $folderPath,
                    'file_name' => $fileName,
                    'file_mime' => \File::mimeType(storage_path('app/public/' . $file)),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'recognized' => false,
                    'status' => true,
                ]);
                return redirect(route('absent-face'))->with('message_error', 'Wajah Anda Dikenali Pada Wajah Orang Lain!');
            }
        }else{
            $Absent = Absent::create([
                'id_user' => Auth::user()->id,
                'url_path' => $folderPath,
                'file_name' => $fileName,
                'file_mime' => \File::mimeType(storage_path('app/public/' . $file)),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'recognized' => false,
                'status' => false,
            ]);
            return redirect(route('absent-face'))->with('message_error', 'Gagal Mendeteksi Wajah Anda!');
        }
        
    }

    public function history_absent(Request $request)
    {
        $Absent = Absent::with('user');
        if(Auth::user()->role == 'administrator'){
            $Absent = $Absent->get();
        }else{
            $Absent = $Absent->where('id_user', Auth::user()->id)->where('status', true)->get();
        }
        
        return Datatables::of($Absent)
            ->editColumn('user.name', function($data) {

                return $data->user->name;
            })
            ->editColumn('status', function($data) {
                if($data->status == true){
                    $status = 'Berhasil';
                }else{
                    $status = 'Tidak Berhasil';
                }
                return $status;
            })
            ->editColumn('created_at', function($data) {
                return Carbon::parse($data->created_at)->format("d-m-Y H:s");
            })
            ->addColumn('action', function ($data) {
                $action = "<a href='". route('absent.detail-absent', [$data->id]) ."' class='btn btn-outline-secondary text-secondary' title='Aprove'><i class='feather icon-eye'></i> Detail</a>";
                return $action;
            })->make(true);
        
    }

    public function history_absent_period(Request $request)
    {
        $Absent = User::with('absent')->get();
        dd($Absent);

        
        return Datatables::of($Absent)
            ->editColumn('user.name', function($data) {

                return $data->user->name;
            })
            ->editColumn('status', function($data) {
                if($data->status == true){
                    $status = 'Berhasil';
                }else{
                    $status = 'Tidak Berhasil';
                }
                return $status;
            })
            ->editColumn('created_at', function($data) {
                return Carbon::parse($data->created_at)->format("d-m-Y H:s");
            })
            ->addColumn('action', function ($data) {
                $action = "<a href='". route('absent.detail-absent', [$data->id]) ."' class='btn btn-outline-secondary text-secondary' title='Aprove'><i class='feather icon-eye'></i> Detail</a>";
                return $action;
            })->make(true);
        
    }

    public function detail_absent(Request $request)
    {
        $Absent = Absent::with('user')->where('id', $request->id)->first();
        $Absent->created_at = Carbon::parse($Absent->created_at)->format("d-m-Y H:s");
        $Absent->url_img = $Absent->url_path . $Absent->file_name;
        $lat = ((float)$Absent->latitude);
        $lng = ((float)$Absent->longitude);
        Mapper::map($lat,$lng, ['zoom' => 15,'center' => true, 'markers' => ['title' => 'My Location', 'animation' => 'DROP']]);

        return view('absent.absent-detail', compact('Absent'));
    }
}
