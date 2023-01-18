<?php

namespace Database\Seeders;

use App\Models\CollegeType;
use Illuminate\Database\Seeder;

class CollegeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'gvo',
            'pvo',

        ];
        foreach ($types as $type) {
            $model = CollegeType::whereType($types);
            if ($model->count() == 0) {
                CollegeType::create(['type' => $type]);
            }
        }
    }
}
