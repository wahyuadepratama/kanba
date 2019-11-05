<?php

namespace App\Http\Controllers\Coach;

use DB;
use App\Models\Schedule;
use App\Models\CoachTrainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;

class CoachTraineeController extends Controller
{
    public function index(){
      $data = DB::table('schedules')
                     ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                     ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                     ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name', 'schedules.datetime', 'schedules.actual')
                     ->where('coach_trainees.coach_nik', session('login')->nik)
                     ->whereMonth('schedules.datetime', date('m'))
                     ->whereYear('schedules.datetime', date('Y'))
                     ->get();
      $trainee = $this->convertDateToHumans($data);
      return view('coach.status')->with(compact('trainee'));
    }

    public function upload(Request $request){
      $request->validate([
        'description' => 'required'
      ]);

      // $time = time() .'.jpg';

      // $img = Image::make($request->file('file'))->resize(300, 200);
      // $img->save('coaching/'. $time, 30);

      $sch = Schedule::find($request->id);
      $sch->photo = $request->description;
      $sch->actual = $this->convertDate($request->schedule);
      $sch->status = 'past';
      $sch->save();

      return back()->with('success', 'Konfirmasi pelaksanaan berhasil! Terima kasih sudah melakukan coaching.');
    }

    public function filter(Request $request)
    {
      $data = DB::table('schedules')
                     ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                     ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                     ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name', 'schedules.datetime', 'schedules.actual')
                     ->where('coach_trainees.coach_nik', session('login')->nik)
                     ->whereMonth('schedules.datetime', $request->month)
                     ->whereYear('schedules.datetime', $request->year)
                     ->get();
      $trainee = $this->convertDateToHumans($data);

      $no=1;
      foreach($trainee as $t){
        echo '<tr>
          <td>'. $no++ .'</td>
          <td class="Materi Coaching  &#xa;">'. $t->photo . '</td>
          <td data-th="Anak Asuh  &#xa;">'. $t->name .'</td>
          <td data-th="Jadwal Coaching  &#xa;">'. $t->datetime .'</td>
          <td data-th="Actual Coaching &#xa;">';
            if($t->status == 'ongoing'){
              echo '-';
            }else{
              echo '<p class="text text-success text-weight-bold">'. $t->actual .'</p>';
            }
          echo '</td>
          <td>';
            if($t->status == 'ongoing'){
              echo '<center>
              <a class="btn btn-primary btn-sm from-control" href="#" data-toggle="modal" data-target="#uploadPhoto" onclick="showUploadModal('. $t->id .')">
                 <span class="icon text-white-50">
                   <i class="fas fa-plus"></i>
                 </span>
                 <span class="text">Submit Materi</span>
               </a>
             </center>';
            }else{
              echo '<p style="text-align:center">Sudah Disubmit!</p>';
            }
            echo '<hr class="d-md-none"><br>
          </td>
        </tr>';
      }
    }

    public function convertDateToHumans($jsons){
      foreach ($jsons as $json){
        $json->datetime = date('d F Y', strtotime($json->datetime));
        $json->actual = date('d F Y', strtotime($json->actual));
      }
      return $jsons;
    }

    public function convertDate($date){
      $date = str_replace('/', '-', $date);
      return date("Y-m-d", strtotime($date));
    }
}
