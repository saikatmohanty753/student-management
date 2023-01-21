<?php

namespace App\Jobs;

use App\Models\AdmissionSeat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CollegeAdmissionSeat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admissionYear;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->admissionYear = date('Y');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        AdmissionSeat::create([
            'admission_year' => 111,
            'clg_id' => '1',
            'department_id' => '1',
            'course_id' => '1',
            'available_seat' => '60',
            'consumption_seat' => '70',
        ]);
    }
}
