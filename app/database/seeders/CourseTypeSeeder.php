<?php

namespace Database\Seeders;

use App\Models\CourseType;
use Illuminate\Database\Seeder;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Professional',
            'Non-Professional',

        ];
        foreach ($types as $type) {
            $model = CourseType::whereCourseType($type);
            if ($model->count() == 0) {
                CourseType::create(['course_type' => $type]);
            }
        }
    }
}
