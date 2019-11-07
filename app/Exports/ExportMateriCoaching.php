<?php

namespace App\Exports;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportMateriCoaching implements FromCollection, WithHeadings
{
    public $year;
    public $month;
    public $coach;

    public function __construct($year, $month, $coach)
    {
      $this->year = $year;
      $this->month = $month;
      $this->coach = $coach;
    }

    public function collection()
    {
      if ($this->coach == 'all') {

        $coach = User::where('role_id', 2)->orderBy('name')->get();

        $data = DB::table('schedules')
                       ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                       ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                       ->select('schedules.id', 'schedules.status','schedules.photo', 'coach_trainees.trainee_nik', 'users.name', 'schedules.datetime', 'schedules.actual', 'coach_trainees.coach_nik as coach_id')
                       // ->where('coach_trainees.coach_nik', session('login')->nik)
                       ->whereMonth('schedules.datetime', $this->month)
                       ->whereYear('schedules.datetime', $this->year)
                       ->get();

        foreach ($data as $t) {
          foreach($coach as $c){
            if($c->nik == $t->coach_id){
              $t->coach = $c->name;
            }
          }
        }
      }else{
        $data = DB::table('schedules')
                       ->join('coach_trainees', 'schedules.relationship_id', '=', 'coach_trainees.id')
                       ->join('users', 'coach_trainees.trainee_nik', '=', 'users.nik')
                       ->select('schedules.id', 'schedules.status','schedules.photo', 'coach_trainees.trainee_nik', 'users.name', 'schedules.datetime', 'schedules.actual', 'coach_trainees.coach_nik as coach_id')
                       ->where('coach_trainees.coach_nik', $this->coach)
                       ->whereMonth('schedules.datetime', $this->month)
                       ->whereYear('schedules.datetime', $this->year)
                       ->get();
      }

      foreach ($data as $key) {
        if ($key->status == 'past') {
          $key->status = 'Sudah Disubmit!';
        }else{
          $key->status = 'Belum Disubmit!';
        }
      }
      return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Pelaksanaan',
            'Materi Coaching',
            'NIK Trainee',
            'Anak Asuh',
            'Jadwal Coaching',
            'Actual Coaching',
            'NIK Coach',
            'Coach'
        ];
    }
}
