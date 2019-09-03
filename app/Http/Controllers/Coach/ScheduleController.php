<?php

namespace App\Http\Controllers\Coach;

use DB;
use App\Models\CoachTrainee;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
  public function index(){
    $data = DB::table('coach_trainees')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('coach_trainees.id', 'users.name', 'users.phone', 'users.nik')
                   ->where('coach_trainees.coach_nik', session('login')->nik)
                   ->get();
    return view('coach.buat_jadwal')->with(compact('data'));
  }

  public function convertDateToHumans($jsons){
    foreach ($jsons as $json)
      $json->datetime = date('d F Y', strtotime($json->datetime));

    return $jsons;
  }

  public function store(Request $request){
    Schedule::create([
      'datetime' => $this->convertDate($request->sch),
      'relationship_id' => $request->id,
      'status' => 'ongoing'
    ]);

    $trainee = DB::table('coach_trainees')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('coach_trainees.id', 'users.name', 'users.phone', 'users.nik')
                   ->where('coach_trainees.coach_nik', session('login')->nik)
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
             echo '<a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $data->id .'\')"><i class="fas fa-trash"></i> Hapus Jadwal</a>';
           }
         echo '<hr></td>
       </tr>
       ';
     }
  }

  public function destroy(Request $request, $id){
    Schedule::where('id', $id)->delete();
    $trainee = DB::table('coach_trainees')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('coach_trainees.id', 'users.name', 'users.phone', 'users.nik')
                   ->where('coach_trainees.coach_nik', session('login')->nik)
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
             echo '<a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $data->id .'\')"><i class="fas fa-trash"></i> Hapus Jadwal</a>';
           }
         echo '<hr></td>
       </tr>
       ';
     }
  }

  public function filter(Request $request)
  {
    $trainee = DB::table('coach_trainees')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('coach_trainees.id', 'users.name', 'users.phone', 'users.nik')
                   ->where('coach_trainees.coach_nik', session('login')->nik)
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
             echo '<a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $data->id .'\')"><i class="fas fa-trash"></i> Hapus Jadwal</a>';
           }
         echo '<hr></td>
       </tr>
       ';
     }
  }

  public function convertDate($date){
    $date = str_replace('/', '-', $date);
    return date("Y-m-d", strtotime($date));
  }

  public function sendWhatsapp()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.wassenger.com/v1/messages",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"phone\":\"+6281251766264\",\"message\":\"Hello tia hahahahahah.\"}",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json",
        "token: 3ce0d68245ac1b3e177ed5c903138fa968ee7085f7a89947ffa452339896f144b9bc7ca7e829f700"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err)
      echo "cURL Error #:" . $err;
    else
      echo $response;

  }
}
