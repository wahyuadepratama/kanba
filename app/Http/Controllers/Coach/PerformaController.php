<?php

namespace App\Http\Controllers\Coach;

use DB;
use App\Models\User;
use App\Models\Schedule;
use App\Models\CoachTrainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerformaController extends Controller
{
  public function index(){
    if($_GET){
      $month = $_GET['month'];
      $year = $_GET['year'];
      $type = $_GET['type'];

      if ($type == 'yearly')
        return $this->filterYearly($year);

      if ($type == 'monthly')
        return $this->filterMonthly($year, $month);

    }else{
      return $this->getAllData();
    }
  }

  public function getAllData()
  {
    $sch = DB::table('schedules')->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                  ->where('coach_trainees.coach_nik', '=', session('login')->nik)
                  ->whereYear('schedules.datetime', date('Y'))
                  ->select('schedules.*')
                  ->get();
    $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $plans = [0,0,0,0,0,0,0,0,0,0,0,0];
    $actuals = [0,0,0,0,0,0,0,0,0,0,0,0];
    $ontimes = [0,0,0,0,0,0,0,0,0,0,0,0];

    foreach ($sch as $v) {
      $getMonthNumber = date("m", strtotime($v->datetime)) - 1;
      $plans[$getMonthNumber] = $plans[$getMonthNumber] + 1;

      if ($v->actual != null)
        $actuals[$getMonthNumber] = $actuals[$getMonthNumber] + 1;

      if ($v->datetime == $v->actual)
        $ontimes[$getMonthNumber] = $ontimes[$getMonthNumber] + 1;
     }

     for ($i=0; $i < count($ontimes); $i++){
       if ($ontimes[$i] != 0 && $actuals[$i] != 0)
         $ontimes[$i] = $ontimes[$i]/$actuals[$i] * 100;
     }

     for ($i=0; $i < count($actuals); $i++){
       if ($actuals[$i] != 0 && $plans[$i] != 0)
         $actuals[$i] = $actuals[$i]/$plans[$i] * 100;
     }

    $schedule = DB::table('schedules')
                   ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name as trainee',
                     'coach_trainees.coach_nik', 'schedules.datetime', 'schedules.actual')
                   ->whereYear('schedules.datetime', date('Y'))
                   ->get();
    $coach = User::where('role_id', 2)->get();
    $coachTrainee = CoachTrainee::all();

    $plan = 0;
    $coaching = 0;
    $actual = 0;
    $rank = [];
    $compliance = [];

    foreach ($coach as $c) {

      foreach ($schedule as $s) {
        if ($c->nik == $s->coach_nik) {
          $plan++;
          if ($s->actual != null)
            $coaching++;
          if ($s->actual == $s->datetime)
            $actual++;
        }
      }

      if ($plan != 0 && $coaching != 0)
        $archivement = ($coaching/$plan) * 100;
      else
        $archivement = 0;

      if ($coaching != 0 && $actual != 0)
        $compliance = ($actual/$coaching) * 100;
      else
        $compliance = 0;

      array_push($rank, ['nik' => $c->nik, 'coach' => $c->name, 'archivement' => $archivement, 'compliance' => $compliance,
                         'coaching' => $coaching, 'actual' => $actual, 'plan' => $plan]);

      $coaching = 0;
      $plan = 0;
      $actual = 0;
    }

    usort($rank, function($a, $b) { //Sort the array using a user defined function
        return $a['archivement'] > $b['archivement'] ? -1 : 1; //Compare the scores
    });

    return view('coach.performa')->with(compact('actuals', 'rank', 'label', 'plans'));
  }

  public function filterYearly($year)
  {
    $sch = DB::table('schedules')->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                  ->where('coach_trainees.coach_nik', '=', session('login')->nik)
                  ->whereYear('schedules.datetime', $year)
                  ->select('schedules.*')
                  ->get();
    $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    $plans = [0,0,0,0,0,0,0,0,0,0,0,0];
    $actuals = [0,0,0,0,0,0,0,0,0,0,0,0];
    $ontimes = [0,0,0,0,0,0,0,0,0,0,0,0];

    foreach ($sch as $v) {
      $getMonthNumber = date("m", strtotime($v->datetime)) - 1;
      $plans[$getMonthNumber] = $plans[$getMonthNumber] + 1;

      if ($v->actual != null)
        $actuals[$getMonthNumber] = $actuals[$getMonthNumber] + 1;

      if ($v->datetime == $v->actual)
        $ontimes[$getMonthNumber] = $ontimes[$getMonthNumber] + 1;
     }

     for ($i=0; $i < count($ontimes); $i++){
       if ($ontimes[$i] != 0 && $actuals[$i] != 0)
         $ontimes[$i] = $ontimes[$i]/$actuals[$i] * 100;
     }

     for ($i=0; $i < count($actuals); $i++){
       if ($actuals[$i] != 0 && $plans[$i] != 0)
         $actuals[$i] = $actuals[$i]/$plans[$i] * 100;
     }

    $schedule = DB::table('schedules')
                   ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name as trainee',
                     'coach_trainees.coach_nik', 'schedules.datetime', 'schedules.actual')
                   ->whereYear('schedules.datetime', $year)
                   ->get();
    $coach = User::where('role_id', 2)->get();
    $coachTrainee = CoachTrainee::all();

    $plan = 0;
    $coaching = 0;
    $actual = 0;
    $rank = [];
    $compliance = [];

    foreach ($coach as $c) {

      foreach ($schedule as $s) {
        if ($c->nik == $s->coach_nik) {
          $plan++;
          if ($s->actual != null)
            $coaching++;
          if ($s->actual == $s->datetime)
            $actual++;
        }
      }

      if ($plan != 0 && $coaching != 0)
        $archivement = ($coaching/$plan) * 100;
      else
        $archivement = 0;

      if ($coaching != 0 && $actual != 0)
        $compliance = ($actual/$coaching) * 100;
      else
        $compliance = 0;

      array_push($rank, ['nik' => $c->nik, 'coach' => $c->name, 'archivement' => $archivement, 'compliance' => $compliance,
                         'coaching' => $coaching, 'actual' => $actual, 'plan' => $plan]);

      $coaching = 0;
      $plan = 0;
      $actual = 0;
    }

    usort($rank, function($a, $b) { //Sort the array using a user defined function
        return $a['archivement'] > $b['archivement'] ? -1 : 1; //Compare the scores
    });

    return view('coach.performa')->with(compact('actuals', 'rank', 'label', 'plans'));
  }

  public function filterMonthly($year, $month)
  {
    $sch = DB::table('schedules')->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                  ->where('coach_trainees.coach_nik', '=', session('login')->nik)
                  ->whereYear('schedules.datetime', $year)
                  ->whereMonth('schedules.datetime', $month)
                  ->select('schedules.*')
                  ->get();
    $label = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];

    $plans = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    $actuals = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    $ontimes = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

    foreach ($sch as $v) {
      $getDateNumber = date("d", strtotime($v->datetime)) - 1;
      $plans[$getDateNumber] = $plans[$getDateNumber] + 1;

      if ($v->actual != null)
        $actuals[$getDateNumber] = $actuals[$getDateNumber] + 1;

      if ($v->datetime == $v->actual)
        $ontimes[$getDateNumber] = $ontimes[$getDateNumber] + 1;
     }

     $schedule = DB::table('schedules')
                    ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                    ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                    ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name as trainee',
                      'coach_trainees.coach_nik', 'schedules.datetime', 'schedules.actual')
                    ->whereYear('schedules.datetime', $year)
                    ->whereMonth('schedules.datetime', $month)
                    ->get();
    $coach = User::where('role_id', 2)->get();
    $coachTrainee = CoachTrainee::all();

    $plan = 0;
    $coaching = 0;
    $actual = 0;
    $rank = [];
    $compliance = [];

    foreach ($coach as $c) {

      foreach ($schedule as $s) {
        if ($c->nik == $s->coach_nik) {
          $plan++;
          if ($s->actual != null)
            $coaching++;
          if ($s->actual == $s->datetime)
            $actual++;
        }
      }

      if ($plan != 0 && $coaching != 0)
        $archivement = ($coaching/$plan) * 100;
      else
        $archivement = 0;

      if ($coaching != 0 && $actual != 0)
        $compliance = ($actual/$coaching) * 100;
      else
        $compliance = 0;

      array_push($rank, ['nik' => $c->nik, 'coach' => $c->name, 'archivement' => $archivement, 'compliance' => $compliance,
                         'coaching' => $coaching, 'actual' => $actual, 'plan' => $plan]);

      $coaching = 0;
      $plan = 0;
      $actual = 0;
    }

    usort($rank, function($a, $b) { //Sort the array using a user defined function
        return $a['archivement'] > $b['archivement'] ? -1 : 1; //Compare the scores
    });

    return view('coach.performa')->with(compact('actuals', 'rank', 'label', 'plans'));
  }

}
