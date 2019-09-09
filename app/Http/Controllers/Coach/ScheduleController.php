<?php

namespace App\Http\Controllers\Coach;

use DB;
use App\Models\CoachTrainee;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ScheduleController extends Controller
{
  public function index(){
    $data = DB::table('coach_trainees')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('coach_trainees.id', 'users.name', 'users.phone', 'users.nik')
                   ->where('coach_trainees.coach_nik', session('login')->nik)
                   ->where('coach_trainees.month', date('m'))
                   ->where('coach_trainees.year', date('Y'))
                   ->get();
    return view('coach.buat_jadwal')->with(compact('data'));
  }

  public function convertDateToHumans($jsons){
    foreach ($jsons as $json)
      $json->datetime = date('d F Y', strtotime($json->datetime));

    return $jsons;
  }

  public function updateTable(Request $request)
  {
    $trainee = DB::table('coach_trainees')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('coach_trainees.id', 'users.name', 'users.phone', 'users.nik')
                   ->where('coach_trainees.coach_nik', session('login')->nik)
                   ->where('coach_trainees.month', $request->month)
                   ->where('coach_trainees.year', $request->year)
                   ->get();
     $no = 1;
     foreach ($trainee as $d) {
       echo '
       <tr>
         <td data-th="No &#xa;">'. $no++ .'</td>
         <td data-th="Nama &#xa;">'. $d->name .'</td>
         <td data-th="NIK &#xa;">'. $d->nik .'</td>
         <td data-th="Jadwal &#xa;">';
           $data = Schedule::where('relationship_id', $d->id)->whereMonth('datetime', $request->month)
           ->whereYear('datetime', $request->year)->first();
           if($data == null){
             echo '<div class="text text-danger font-weight-bold">
               Belum Dibuat!
             </div>';
           }else{
             echo '<div class="text text-success font-weight-bold">
                '. date('d F Y', strtotime($data->datetime)) .'
             </div>';
           }
         echo
         '</td>
         <td class="text-center">';
           if($data == null){
             echo '<a class="btn btn-primary btn-sm btn-icon-split" href="#" data-toggle="modal" data-target="#addJadwal"
             onclick="addSchedule(\''. $d->id .'\')">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Buat Jadwal</span>
              </a>';
           }else{
             if ($data->actual == null) {
               echo '<a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $data->id .'\')"><i class="fas fa-trash"></i> Hapus Jadwal</a>';
             }else {
               echo '<b>Sudah Dilaksanakan!</b>';
             }
           }
         echo '<hr class="d-md-none"></td>
       </tr>
       ';
     }
  }

  public function store(Request $request){
    Schedule::create([
      'datetime' => $request->sch,
      'relationship_id' => $request->id,
      'status' => 'ongoing'
    ]);

    $this->updateTable($request);
  }

  public function destroy(Request $request, $id){
    $data = Schedule::where('id', $id)->first();

    if ($data->photo != 'default.jpg') {
      $myFile = 'coaching/'. $data->photo;
      if(File::exists($myFile))
        unlink($myFile);
    }

    $data->delete();
    $this->updateTable($request);
  }

  public function filter(Request $request){
    $this->updateTable($request);
  }

  public function convertDate($date){
    $date = str_replace('/', '-', $date);
    return date("Y-m-d", strtotime($date));
  }

}
