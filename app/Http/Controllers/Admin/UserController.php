<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   public function indexCoach(){
     $coach = User::where('role_id', 2)->orderBy('name', 'asc')->get();
     return view('admin.bapak_asuh')->with(compact('coach'));
   }

   public function storeCoach(Request $request){
     User::create([
       'nik' => $request->nik,
       'role_id' => 2,
       'name' => $request->name,
       'phone' => $request->phone,
       'created_at' => date("Y-m-d H:i:s")
     ]);

     return $this->reloadCoach();
   }

   public function updateCoach(Request $request){
     $coach = User::where('nik', $request->current)->first();
     $coach->name = $request->name;
     $coach->nik = $request->nik;
     $coach->phone = $request->phone;
     $coach->save();
     return $this->reloadCoach();
   }

   public function destroyCoach($nik){
     User::where('nik', $nik)->delete();
     return $this->reloadCoach();
   }

   public function reloadCoach()
   {
     $data = User::where('role_id', 2)->orderBy('name', 'asc')->get();
     $no = 1;
     foreach ($data as $key) {
       echo '<tr>
         <td>'. $no++ .'</td>
         <td>'. $key->name .'</td>
         <td>'. $key->nik .'</td>
         <td>'. $key->phone .'</td>
         <td>'. \Carbon\Carbon::parse($key->created_at)->diffForHumans() .'</td>
         <td>
           <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $key->nik .'\', \''. $key->name .'\')">Hapus</a>
           <a class="btn btn-warning btn-sm" href="#" onclick="showModal(\''. $key->name .'\', \''. $key->nik .'\', \''. $key->phone .'\')" data-toggle="modal" data-target="#editBapakAsuh">Edit</a>
         </td>
       </tr>';
     }
   }

   public function indexTrainee(){
     $trainee = User::where('role_id', 3)->orderBy('name', 'asc')->get();
     return view('admin.anak_asuh')->with(compact('trainee'));
   }

   public function storeTrainee(Request $request){
     User::create([
       'nik' => $request->nik,
       'role_id' => 3,
       'name' => $request->name,
       'created_at' => date("Y-m-d H:i:s")
     ]);

     return $this->reloadTrainee();
   }

   public function updateTrainee(Request $request){
     $coach = User::where('nik', $request->current)->first();
     $coach->name = $request->name;
     $coach->nik = $request->nik;
     $coach->phone = $request->phone;
     $coach->save();
     return $this->reloadTrainee();
   }

   public function destroyTrainee($nik){
     User::where('nik', $nik)->delete();
     return $this->reloadTrainee();
   }

   public function reloadTrainee()
   {
     $data = User::where('role_id', 3)->orderBy('name', 'asc')->get();
     $no = 1;
     foreach ($data as $key) {
       echo '<tr>
         <td>'. $no++ .'</td>
         <td>'. $key->name .'</td>
         <td>'. $key->nik .'</td>
         <td>'. \Carbon\Carbon::parse($key->created_at)->diffForHumans() .'</td>
         <td>
           <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $key->nik .'\', \''. $key->name .'\')">Hapus</a>
           <a class="btn btn-warning btn-sm" href="#" onclick="showModal(\''. $key->name .'\', \''. $key->nik .'\', \''. $key->phone .'\')" data-toggle="modal" data-target="#editBapakAsuh">Edit</a>
         </td>
       </tr>';
     }
   }
}
