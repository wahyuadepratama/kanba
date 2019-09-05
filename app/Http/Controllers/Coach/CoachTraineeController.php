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
        'file' => 'required|image'
      ]);

      $time = time() .'.jpg';

      $img = Image::make($request->file('file'))->resize(300, 200);
      $img->save('coaching/'. $time, 30);

      $sch = Schedule::find($request->id);
      $sch->photo = $time;
      $sch->actual = $this->convertDate($request->schedule);
      $sch->status = 'past';
      $sch->save();

      return back()->with('success', 'Upload foto berhasil! Terima kasih sudah melakukan coaching.');
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
          <td class="td-img"> <img src="'. asset('coaching/'. $t->photo).'" alt="" class="mx-auto d-block img-fluid img-thumbnail" width="250"></td>
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
              echo '<form action="'. url('coach-status/upload') .'" method="post" enctype="multipart/form-data">
                <input type="hidden" value="'. csrf_token() .'" name="_token">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="input-group-text">Upload</button>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="file"
                      aria-describedby="inputGroupFileAddon01" required accept="image/*" capture>
                    <label class="custom-file-label" for="inputGroupFile01"></label>
                  </div>
                </div><br>
                <div class="form-group">
                  <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input placeholder="Actual Coaching" class="form-control" type="text" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')" id="date" required name="schedule">
                  </div>
                 </div>
                <input type="hidden" name="id" value="'. $t->id .'">
              </form>';
            }else{
              echo '<p style="text-align:center">Sudah Diupload !</p>';
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
