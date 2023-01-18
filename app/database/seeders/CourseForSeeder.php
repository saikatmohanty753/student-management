<?php

namespace Database\Seeders;

use App\Models\CourseFor;
use Illuminate\Database\Seeder;

class CourseForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'UG',
            'PG',
            'M.Phil',
            'Certificate',

        ];
        foreach ($types as $type) {
            $model = CourseFor::whereCourseFor($type);
            if ($model->count() == 0) {
                CourseFor::create(['course_for' => $type]);
            }
        }
    }
}
