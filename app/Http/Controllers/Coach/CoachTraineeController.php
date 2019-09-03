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
