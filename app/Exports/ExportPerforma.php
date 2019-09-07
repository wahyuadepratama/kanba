<?php

namespace App\Exports;

use DB;
use App\Models\User;
use App\Models\Schedule;
use App\Models\CoachTrainee;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPerforma implements FromCollection
{
    public $year;
    public $month;
    public $type;

    public function __construct($year, $month)
    {
      $this->year = $year;
      $this->month = $month;
    }

    public function collection()
    {
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
    }

    public function headings(): array
    {
        return [
            'Name',
            'Position',
            'BRL/LEVEL',
            'Section',
            'ID_Report',
            'NIK',
            'Date',
            'Time',
            'Location',
            'Detail Location',
            'Danger Category',
            'Danger Code',
            'Description',
            'Risk',
            'Action',
            'Status',
            'Created at',
            'Updated at'
        ];
    }
}
