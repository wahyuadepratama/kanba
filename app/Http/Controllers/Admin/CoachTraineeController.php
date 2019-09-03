<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoachTrainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoachTraineeController extends Controller
{
    public function index(){
      $coach = User::where('role_id', 2)->orderBy('name', 'asc')->get();
      return view('admin.kelola_hubungan')->with(compact("coach"));
    }

    public function destroyTrainee($id){
      CoachTrainee::where('coach_nik', $id)->delete();
      $coach = User::where('role_id', 2)->orderBy('name', 'asc')->get();
      $no = 1;
      foreach ($coach as $d) {
        echo '<tr>
          <td>'. $no++ .'</td>
          <td>'. $d->nik .'</td>
          <td>'. $d->name .'</td>
          <td>'. $d->phone .'</td>
          <td>';
              $trainees = CoachTrainee::where('coach_nik', $d->nik)->get();
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
            <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $d->nik .'\', \''. $d->name .'\')" ><i class="fas fa-trash"></i> Hapus</a>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter"
              onclick="updateTrainee(\''. $d->nik .'\')"><i class="fas fa-user-edit"></i> Update</a>
          </td>
        </tr>';
      }
    }

    public function getTrainee(Request $request){
      $data = CoachTrainee::where('coach_nik', $request->nik)->select('trainee_nik')->get();
      $result= [];
      foreach ($data as $key)
        array_push($result, $key->trainee_nik);

      return $result;
    }

    public function update(Request $request, $id){
      $trainee = $request->trainee;

      $all = CoachTrainee::where('coach_nik', $id)->get();
      foreach ($all as $key) {
        $find = false;
        for ($i=0; $i < count($trainee); $i++){
          if ($key->trainee_nik == $trainee[$i]) {
            $find = true;
          }
        }

        if ($find == false) {
          CoachTrainee::where('coach_nik', $id)->where('trainee_nik', $key->trainee_nik)->delete();
        }
      }

      for ($i=0; $i < count($trainee); $i++) {
        $search = CoachTrainee::where('coach_nik', $id)->where('trainee_nik', $trainee[$i])->first();
        if ($search == null) {
          CoachTrainee::create([
            'coach_nik' => $id,
            'trainee_nik' => $trainee[$i],
            'created_at' => date("Y-m-d H:i:s")
          ]);
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
              $trainees = CoachTrainee::where('coach_nik', $d->nik)->get();
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
            <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $d->nik .'\', \''. $d->name .'\')" ><i class="fas fa-trash"></i> Hapus</a>
            <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#exampleModalCenter"
              onclick="updateTrainee(\''. $d->nik .'\')"><i class="fas fa-user-edit"></i> Update</a>
          </td>
        </tr>';
      }
    }
}
