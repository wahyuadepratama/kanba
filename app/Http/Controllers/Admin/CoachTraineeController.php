<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoachTrainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoachTraineeController extends Controller
{
    public function index(){
      if ($_GET) {
        if(isset($_GET['month']) && isset($_GET['year'])){
          $relationship = CoachTrainee::where('month', $_GET['month'])->where('year', $_GET['year'])->get();
        }elseif (isset($_GET['month'])) {
          $relationship = CoachTrainee::where('month', $_GET['month'])->where('year', date('Y'))->get();
        }
      }else {
        $relationship = CoachTrainee::where('month', date('m'))->where('year', date('Y'))->get();
      }

      $coach = User::where('role_id', 2)->orderBy('name', 'asc')->get();
      $trainee = User::where('role_id', 3)->orderBy('name', 'asc')->get();
      return view('admin.kelola_hubungan')->with(compact("coach", "relationship", "trainee"));
    }

    public function create(Request $request)
    {
      $coach = User::where('nik', $request->coach)->first();
      if ($coach->role_id == 2) {
        return back()->with('success', 'Data dengan NIK '. $request->coach .' sudah terdaftar dan tinggal dibuatkan jadwalnya!');
      } else {
        $coach->role_id = 2;
        $coach->save();
        return back()->with('success', 'Data dengan NIK '. $request->coach .' berhasil ditambahkan sebagai coach! Sekarang anda dapat membuat jadwalnya!');
      }
    }

    public function getTrainee(Request $request){
      $data = CoachTrainee::where('coach_nik', $request->nik)->select('trainee_nik')->where('month', $request->month)->where('year', $request->year)->get();
      $result= [];
      foreach ($data as $key)
        array_push($result, $key->trainee_nik);

      return $result;
    }

    public function update(Request $request, $id){
      $trainee = $request->trainee;

      if ($trainee == null) {
        $all = CoachTrainee::where('coach_nik', $id)->where('month', $request->month)->where('year', $request->year)->delete();
      }else{
        $all = CoachTrainee::where('coach_nik', $id)->where('month', $request->month)->where('year', $request->year)->get();
        foreach ($all as $key) {
          $find = false;
          for ($i=0; $i < count($trainee); $i++){
            if ($key->trainee_nik == $trainee[$i])
              $find = true;
          }
          if ($find == false)
            CoachTrainee::where('coach_nik', $id)->where('trainee_nik', $key->trainee_nik)->delete();
        }

        for ($i=0; $i < count($trainee); $i++) {
          $search = CoachTrainee::where('coach_nik', $id)->where('trainee_nik', $trainee[$i])->where('month', $request->month)->where('year', $request->year)->first();
          if ($search == null) {
            CoachTrainee::create([
              'coach_nik' => $id,
              'trainee_nik' => $trainee[$i],
              'month' => $request->month,
              'year' => $request->year,
              'created_at' => date("Y-m-d H:i:s")
            ]);
          }
        }
      }

      $coach = User::where('role_id', 2)->orderBy('name', 'asc')->get();
      $no = 1;
      foreach ($coach as $d) {
        echo '<tr>
          <td>'. $no++ .'</td>
          <td>'. $d->nik .'</td>
          <td>'. $d->name .'</td>
          <td>'. $d->phone .'</td>
          <td>';
              $trainees = CoachTrainee::where('coach_nik', $d->nik)->where('month', $request->month)->where('year', $request->year)->get();
              if (!$trainees->isEmpty()) {
                echo '<ul>';
                foreach($trainees as $trainee){
                    echo '<li>'. $trainee->trainee->name .'</li>';
                }
                echo '</ul>';
              }else{
                  echo '<p>Belum ada anak asuh !</p>';
              }
            echo '</td>
          <td>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter"
              onclick="updateTrainee(\''. $d->nik .'\')">Update</a>
          </td>
        </tr>';
      }
    }
}
