<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReminderController extends Controller
{
    public function reminderOneDay()
    {
      $sch = Schedule::whereYear('datetime', date('Y'))->whereMonth('datetime', date('m'))->get();
      foreach ($sch as $data) {
        if (date('d', strtotime($data->datetime)) - 2 == date('d') - 1) {
          // Hello '+ name +', berikut adalah jadwal coaching anda bulan ini: \n\n'+ data + '\nJangan lupa untuk mengingatkan anak asuh anda ya ^_^ dan jangan lupa juga untuk upload foto setelah coaching di https://coachingbuma.com' + '\n\nTerima Kasih
        }
      }
    }

    public function reminderTwoDays()
    {
      $sch = Schedule::whereYear('datetime', date('Y'))->whereMonth('datetime', date('m'))->get();
      foreach ($sch as $data) {
        if (date('d', strtotime($data->datetime)) - 3 == date('d') - 1) {
          // Hello '+ name +', berikut adalah jadwal coaching anda bulan ini: \n\n'+ data + '\nJangan lupa untuk mengingatkan anak asuh anda ya ^_^ dan jangan lupa juga untuk upload foto setelah coaching di https://coachingbuma.com' + '\n\nTerima Kasih
        }
      }
    }

    public function reminderThreeDays()
    {
      $sch = Schedule::whereYear('datetime', date('Y'))->whereMonth('datetime', date('m'))->get();
      foreach ($sch as $data) {
        if (date('d', strtotime($data->datetime)) - 4 == date('d') - 1) {
          // Hello '+ name +', berikut adalah jadwal coaching anda bulan ini: \n\n'+ data + '\nJangan lupa untuk mengingatkan anak asuh anda ya ^_^ dan jangan lupa juga untuk upload foto setelah coaching di https://coachingbuma.com' + '\n\nTerima Kasih
        }
      }
    }

    public function reminderEveryWeek()
    {
      $sch = Schedule::whereYear('datetime', date('Y'))->whereMonth('datetime', date('m'))->with('relationship')->get();

      foreach ($sch as $data) {

        $msg = 'Hello '. $data->relationship->coach->name .', berikut adalah status coaching kamu bulan ini: \n\n'.$data.'\nJangan lupa untuk mengingatkan anak asuh anda ya ^_^ dan jangan lupa juga untuk input materi setelah coaching di https://coachingbuma.com' + '\n\nTerima Kasih';
        $post = [
          'phone' => $data->relationship->coach->phone,
          'message' => $msg
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

}
