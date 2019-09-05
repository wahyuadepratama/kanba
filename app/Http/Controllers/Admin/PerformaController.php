<?php

namespace App\Http\Controllers\Admin;

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

      if($month == "all")
        return $this->getFilterYearData($year);
      else
        return $this->getFilterAllData($month, $year);

    }else{
      return $this->getAllData();
    }
  }

  public function getAllData()
  {
    $sch = Schedule::whereYear('datetime', date('Y'))->get();
    $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $data = [0,0,0,0,0,0,0,0,0,0,0,0];
    $data2 = [0,0,0,0,0,0,0,0,0,0,0,0];
    foreach ($sch as $v) {
      $getMonthNumber = date("m", strtotime($v->datetime)) - 1;
      $data[$getMonthNumber] = $data[$getMonthNumber] + 1;

      if ($v->datetime == $v->actual) {
        $data2[$getMonthNumber] = $data2[$getMonthNumber] + 1;
      }
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

    $coaching = 0;
    $trainee = 0;
    $plan = 0;
    $actual = 0;
    $rank = [];
    $compliance = [];

    foreach ($coach as $c) {
      foreach ($coachTrainee as $ct) {
        if ($c->nik == $ct->coach_nik)
          $trainee++;
      }

      foreach ($schedule as $s) {
        if ($c->nik == $s->coach_nik) {
          $plan++;
          if ($s->actual != null)
            $coaching++;

          if ($s->actual == $s->datetime)
            $actual++;
        }
      }

      if ($trainee != 0 && $coaching != 0)
        $archivement = (($coaching/$trainee) * 100)/12;
      else
        $archivement = 0;

      if ($plan != 0 && $actual != 0)
        $compliance = (($actual/$plan) * 100)/12;
      else
        $compliance = 0;

      array_push($rank, ['nik' => $c->nik, 'coach' => $c->name, 'archivement' => $archivement, 'compliance' => $compliance,
                         'coaching' => $coaching, 'actual' => $actual, 'plan' => $plan, 'trainee' => $trainee]);

      $coaching = 0;
      $trainee = 0;
      $plan = 0;
      $actual = 0;
    }

    usort($rank, function($a, $b) { //Sort the array using a user defined function
        return $a['archivement'] > $b['archivement'] ? -1 : 1; //Compare the scores
    });

    return view('admin.performa')->with(compact('data', 'rank', 'label', 'data2'));
  }

  public function getFilterYearData($year)
  {
    $sch = Schedule::whereYear('datetime', $year)->get();
    $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $data = [0,0,0,0,0,0,0,0,0,0,0,0];
    $data2 = [0,0,0,0,0,0,0,0,0,0,0,0];
    foreach ($sch as $v) {
      $getMonthNumber = date("m", strtotime($v->datetime)) - 1;
      $data[$getMonthNumber] = $data[$getMonthNumber] + 1;

      if ($v->datetime == $v->actual) {
        $data2[$getMonthNumber] = $data2[$getMonthNumber] + 1;
      }
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

    $coaching = 0;
    $trainee = 0;
    $plan = 0;
    $actual = 0;
    $rank = [];
    $compliance = [];

    foreach ($coach as $c) {
      foreach ($coachTrainee as $ct) {
        if ($c->nik == $ct->coach_nik)
          $trainee++;
      }

      foreach ($schedule as $s) {
        if ($c->nik == $s->coach_nik) {
          $plan++;
          if ($s->actual != null)
            $coaching++;

          if ($s->actual == $s->datetime)
            $actual++;
        }
      }

      if ($trainee != 0 && $coaching != 0)
        $archivement = (($coaching/$trainee) * 100)/12;
      else
        $archivement = 0;

      if ($plan != 0 && $actual != 0)
        $compliance = (($actual/$plan) * 100)/12;
      else
        $compliance = 0;

      array_push($rank, ['nik' => $c->nik, 'coach' => $c->name, 'archivement' => $archivement, 'compliance' => $compliance,
                         'coaching' => $coaching, 'actual' => $actual, 'plan' => $plan, 'trainee' => $trainee]);

      $coaching = 0;
      $trainee = 0;
      $plan = 0;
      $actual = 0;
    }

    usort($rank, function($a, $b) { //Sort the array using a user defined function
        return $a['archivement'] > $b['archivement'] ? -1 : 1; //Compare the scores
    });

    return view('admin.performa')->with(compact('data', 'rank', 'label', 'data2'));
  }

  public function getFilterAllData($month, $year)
  {
    $sch = Schedule::whereMonth('datetime', $month)->whereYear('datetime', $year)->get();
    $label = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
    $data = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    $data2 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
    foreach ($sch as $v) {
      $getDateNumber = date("d", strtotime($v->datetime)) - 1;
      $data[$getDateNumber] = $data[$getDateNumber] + 1;

      if ($v->datetime == $v->actual) {
        $data2[$getDateNumber] = $data2[$getDateNumber] + 1;
      }
    }

    $schedule = DB::table('schedules')
                   ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                   ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                   ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name as trainee',
                     'coach_trainees.coach_nik', 'schedules.datetime', 'schedules.actual')
                   ->whereYear('schedules.datetime', $year)
                   ->whereMonth('datetime', $month)
                   ->get();
    $coach = User::where('role_id', 2)->get();
    $coachTrainee = CoachTrainee::all();

    $coaching = 0;
    $trainee = 0;
    $plan = 0;
    $actual = 0;
    $rank = [];
    $compliance = [];

    foreach ($coach as $c) {
      foreach ($coachTrainee as $ct) {
        if ($c->nik == $ct->coach_nik)
          $trainee++;
      }

      foreach ($schedule as $s) {
        if ($c->nik == $s->coach_nik) {
          $plan++;
          if ($s->actual != null)
            $coaching++;

          if ($s->actual == $s->datetime)
            $actual++;
        }
      }

      if ($trainee != 0 && $coaching != 0)
        $archivement = ($coaching/$trainee) * 100;
      else
        $archivement = 0;

      if ($plan != 0 && $actual != 0)
        $compliance = ($actual/$plan) * 100;
      else
        $compliance = 0;

      array_push($rank, ['nik' => $c->nik, 'coach' => $c->name, 'archivement' => $archivement, 'compliance' => $compliance,
                         'coaching' => $coaching, 'actual' => $actual, 'plan' => $plan, 'trainee' => $trainee]);

      $coaching = 0;
      $trainee = 0;
      $plan = 0;
      $actual = 0;
    }

    usort($rank, function($a, $b) { //Sort the array using a user defined function
        return $a['archivement'] > $b['archivement'] ? -1 : 1; //Compare the scores
    });

    return view('admin.performa')->with(compact('data', 'rank', 'label', 'data2'));
  }
}
