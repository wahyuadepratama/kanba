<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
      $count = 0;
      if($_GET){
        $data = DB::table('schedules')
                       ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                       ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                       ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name', 'schedules.datetime', 'schedules.actual')
                       // ->where('coach_trainees.coach_nik', session('login')->nik)
                       ->whereMonth('schedules.datetime', date('m'))
                       ->whereYear('schedules.datetime', date('Y'))
                       ->where('schedules.photo', 'like', '%'. $_GET['search'] .'%')
                      ->get();
        $count = count($data);

        if ($_GET['search'] == '') {
          $count = 0;
        }
      }else{
        $data = DB::table('schedules')
                       ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                       ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                       ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name', 'schedules.datetime', 'schedules.actual')
                       // ->where('coach_trainees.coach_nik', session('login')->nik)
                       ->whereMonth('schedules.datetime', date('m'))
                       ->whereYear('schedules.datetime', date('Y'))
                      ->get();
      }

      $trainee = $this->convertDateToHumans($data);
      // return $trainee;
      $coach = User::where('role_id', 2)->orderBy('name')->get();
      return view('admin.gallery')->with(compact('trainee', 'coach', 'count'));
    }

    public function filter(Request $request)
    {
      if ($request->coach == 'all') {
        $data = DB::table('schedules')
                       ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                       ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                       ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name', 'schedules.datetime', 'schedules.actual')
                       // ->where('coach_trainees.coach_nik', session('login')->nik)
                       ->whereMonth('schedules.datetime', $request->month)
                       ->whereYear('schedules.datetime', $request->year)
                       ->get();
      }else{
        $data = DB::table('schedules')
                       ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                       ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                       ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name', 'schedules.datetime', 'schedules.actual')
                       ->where('coach_trainees.coach_nik', $request->coach)
                       ->whereMonth('schedules.datetime', $request->month)
                       ->whereYear('schedules.datetime', $request->year)
                       ->get();
      }

      $trainee = $this->convertDateToHumans($data);

      $no=1;
      foreach($trainee as $t){
        echo '<tr>
          <td>'. $no++ .'</td>
          <td class="Materi Coaching  &#xa;"> '. $t->photo .'</td>
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
              echo '<p style="text-align:center">Belum Disubmit!</p>';
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
}
