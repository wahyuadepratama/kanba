<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Schedule;
use App\Models\CoachTrainee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportArchievement implements FromCollection, WithHeadings
{
  public $year;
  public $month;

  public function __construct($year, $month)
  {
    $this->year = $year;
    $this->month = $month;
  }

  public function collection()
  {
    if ($this->month == 'all') {
      $schedule = DB::table('schedules')
                     ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                     ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                     ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name as trainee',
                       'coach_trainees.coach_nik', 'schedules.datetime', 'schedules.actual')
                     ->whereYear('schedules.datetime', $this->year)
                     ->get();
      $coach = User::where('role_id', 2)->get();
      $coachTrainee = CoachTrainee::all();

      $no = 1;
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

        if ($archivement != 0) {
          array_push($rank, (object) ['no' => $no++, 'coach' => $c->name, 'nik' => $c->nik,
                             'plan' => $plan, 'coaching' => $coaching, 'archivement' => $archivement ]);
        }

        $coaching = 0;
        $plan = 0;
        $actual = 0;
      }

      $collection = collect($rank);
      $s = $collection->sortByDesc('archivement');

      $no = 1;
      foreach ($s as $key)
        $key->no = $no++;

      return $s;

    }else{

      $schedule = DB::table('schedules')
                     ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                     ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                     ->select('schedules.id', 'schedules.status','schedules.photo', 'users.name as trainee',
                       'coach_trainees.coach_nik', 'schedules.datetime', 'schedules.actual')
                     ->whereYear('schedules.datetime', $this->year)
                     ->whereMonth('schedules.datetime', $this->month)
                     ->get();
      $coach = User::where('role_id', 2)->get();
      $coachTrainee = CoachTrainee::all();

      $no = 1;
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

        if ($archivement != 0) {
          array_push($rank, (object) ['no' => $no++, 'coach' => $c->name, 'nik' => $c->nik,
                             'plan' => $plan, 'coaching' => $coaching, 'archivement' => $archivement ]);
        }

        $coaching = 0;
        $plan = 0;
        $actual = 0;
      }

      $collection = collect($rank);
      $s = $collection->sortByDesc('archivement');

      $no = 1;
      foreach ($s as $key)
        $key->no = $no++;

      return $s;
    }
  }

  public function headings(): array
  {
      return [
          'No',
          'Nama',
          'NIK',
          'Terjadwal',
          'Terlaksana',
          'Archivement'
      ];
  }
}
