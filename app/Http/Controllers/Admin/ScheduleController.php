<?php

namespace App\Http\Controllers\Admin;

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
      $coach = User::where('role_id', 2)->orderBy('name', 'asc')->get();
      $relationship = CoachTrainee::all();
      $schedule = Schedule::whereMonth('datetime', (int) date('m'))->get();

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

    public function reminderAutomatic($nik)
    {
      $data = User::where('nik', $nik)->first();
      $post = [
        'phone' => $data->phone,
        'message' => 'Hello '. $data->name .'. Kami mau mengingatkan jadwal coaching untuk anak asuh anda sebagai berikut: <br> tes1: 13 September 2019 \n tes2: 12 Agustus 2019 <br><br> '. date('d m Y h:i:s')
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

      return back()->with('success', 'Pesan reminder otomatis berhasil dikirim! Tunggu beberapa menit hingga pesan berhasil masuk!');
    }

    public function reminderManual(Request $request)
    {
      echo $request->text;
      die('');
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
