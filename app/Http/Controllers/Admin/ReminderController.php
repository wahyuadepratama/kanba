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

}
