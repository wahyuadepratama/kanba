<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   public function indexCoach(){
     $coach = User::where('role_id', 2)->orderBy('created_at', 'desc')->get();
     return view('admin.bapak_asuh')->with(compact('coach'));
   }

   public function indexTrainee(){
     $trainee = User::where('role_id', 3)->orderBy('created_at', 'desc')->get();
     return view('admin.anak_asuh')->with(compact('trainee'));
   }

   public function storeCoach(Request $request){
     User::create([
       'nik' => $request->nik,
       'password' => bcrypt($request->password),
       'role_id' => 2,
       'name' => $request->name,
       'phone' => $request->phone,
       'created_at' => date("Y-m-d H:i:s")
     ]);

     $data = User::where('role_id', 2)->get();
     $no = 1;
     foreach ($data as $key) {
         echo '<tr>
           <td>'. $no++ .'</td>
           <td>'. $key->name .'</td>
           <td>'. $key->nik .'</td>
           <td>'. $key->phone .'</td>
           <td>'. \Carbon\Carbon::parse($key->created_at)->diffForHumans() .'</td>
           <td>
             <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $key->nik .'\', \''. $key->name .'\')"><i class="fas fa-trash"></i> Hapus</a>
           </td>
         </tr>';
     }
   }

   public function storeTrainee(Request $request){
     User::create([
       'nik' => $request->nik,
       'password' => bcrypt($request->password),
       'role_id' => 3,
       'name' => $request->name,
       'created_at' => date("Y-m-d H:i:s")
     ]);

     $data = User::where('role_id', 3)->get();
     $no = 1;
     foreach ($data as $key) {
         echo '<tr>
           <td>'. $no++ .'</td>
           <td>'. $key->name .'</td>
           <td>'. $key->nik .'</td>
           <td>'. \Carbon\Carbon::parse($key->created_at)->diffForHumans() .'</td>
           <td>
             <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $key->nik .'\', \''. $key->name .'\')"><i class="fas fa-trash"></i> Hapus</a>
           </td>
         </tr>';
     }
   }

   public function destroyCoach($nik){
     User::where('nik', $nik)->delete();
     $data = User::where('role_id', 2)->get();
     $no = 1;
     foreach ($data as $key) {
       echo '<tr>
         <td>'. $no++ .'</td>
         <td>'. $key->name .'</td>
         <td>'. $key->nik .'</td>
         <td>'. $key->phone .'</td>
         <td>'. \Carbon\Carbon::parse($key->created_at)->diffForHumans() .'</td>
         <td>
           <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $key->nik .'\', \''. $key->name .'\')"><i class="fas fa-trash"></i> Hapus</a>
         </td>
       </tr>';
     }
   }

   public function destroyTrainee($nik){
     User::where('nik', $nik)->delete();
     $data = User::where('role_id', 3)->get();
     $no = 1;
     foreach ($data as $key) {
       echo '<tr>
         <td>'. $no++ .'</td>
         <td>'. $key->name .'</td>
         <td>'. $key->nik .'</td>
         <td>'. \Carbon\Carbon::parse($key->created_at)->diffForHumans() .'</td>
         <td>
           <a class="btn btn-google btn-sm" href="#" onclick="destroyConfirm(\''. $key->nik .'\', \''. $key->name .'\')"><i class="fas fa-trash"></i> Hapus</a>
         </td>
       </tr>';
     }
   }
}
