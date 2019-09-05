<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Schedule;
use App\Models\CoachTrainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
      $kelolaHubungan = CoachTrainee::all()->count();
      $kelolaJadwal = Schedule::all()->count();
      $scheduled = Schedule::where('actual', null)->count();
      $bapakAsuh = User::where('role_id', 2)->get()->count();
      $anakAsuh = User::where('role_id', 3)->get()->count();
      return view('admin.home')->with(compact('kelolaHubungan', 'kelolaJadwal', 'scheduled', 'anakAsuh', 'bapakAsuh'));
    }
}
