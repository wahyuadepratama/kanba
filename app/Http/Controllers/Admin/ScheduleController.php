<?php

namespace App\Http\Controllers\Admin;

use DB;
use Config;
use App\Models\User;
use App\Models\Schedule;
use App\Models\CoachTrainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
      if ($_GET) {
        if(isset($_GET['month']) && isset($_GET['year'])){
          $coach = DB::table('coach_trainees')
                    ->join('users', 'users.nik', '=', 'coach_trainees.coach_nik')
                    ->groupBy('coach_trainees.coach_nik')
                    ->select('users.name', 'users.nik')
                    ->where('month', $_GET['month'])
                    ->where('year', $_GET['year'])
                    ->get();
          $relationship = CoachTrainee::where('month', $_GET['month'])->where('year', $_GET['year'])->get();
          $schedule = Schedule::whereMonth('datetime', $_GET['month'])->whereYear('datetime', $_GET['year'])->get();
        }elseif (isset($_GET['month'])) {
          $coach = DB::table('coach_trainees')
                    ->join('users', 'users.nik', '=', 'coach_trainees.coach_nik')
                    ->groupBy('coach_trainees.coach_nik')
                    ->select('users.name', 'users.nik')
                    ->where('month', $_GET['month'])
                    ->where('year', date('Y'))
                    ->get();
          $relationship = CoachTrainee::where('month', $_GET['month'])->where('year', date('Y'))->get();
          $schedule = Schedule::whereMonth('datetime', $_GET['month'])->whereYear('datetime', date('Y'))->get();
        }
      }else {
        $coach = DB::table('coach_trainees')
                  ->join('users', 'users.nik', '=', 'coach_trainees.coach_nik')
                  ->groupBy('coach_trainees.coach_nik')
                  ->select('users.name', 'users.nik')
                  ->where('month', date('m'))
                  ->where('year', date('Y'))
                  ->get();
        $relationship = CoachTrainee::where('month', date('m'))->where('year', date('Y'))->get();
        $schedule = Schedule::whereMonth('datetime', date('m'))->whereYear('datetime', date('Y'))->get();
      }

      $this->convertDateToHumans($schedule);

      return view('admin.kelola_jadwal')->with(compact("coach", "relationship", "schedule"));
    }

    public function convertDateToHumans($jsons)
    {
      foreach ($jsons as $json){
        $json->datetime = date('d F Y', strtotime($json->datetime));
        $json->actual = date('d F Y', strtotime($json->actual));
      }

      return $jsons;
    }

    public function getDataCoaching($nik, $month, $year)
    {
      $relationship = CoachTrainee::where('month', $month)->where('year', $year)->get();
      $schedule = Schedule::whereMonth('datetime', $month)->whereYear('datetime', $year)->get();

      foreach($relationship as $r)
        if($r->coach_nik == $nik){
          echo $r->trainee->name." : ";
          $found = false;
          foreach($schedule as $s){
            if($s->relationship_id == $r->id){
              if($s->status == "ongoing")
                echo $s->datetime .'\n';
              else
                echo $s->actual .'\n';

              $found = true;
            }
          }
          if ($found == false)
            echo "Belum dibuat!\n";
        }
    }

    public function reminderManual(Request $request)
    {
      return $request->text;

      $data = User::where('nik', $request->nik)->first();
      $post = [
        'phone' => $data->phone,
        'message' => $request->text
      ];

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => Config::get('app.url_send_message_whatsapp'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($post),
        CURLOPT_HTTPHEADER => array(
          "content-type: application/json",
          "token: ". Config::get('app.api_send_message_whatsapp')
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
