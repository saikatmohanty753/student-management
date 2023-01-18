<?php

namespace Database\Seeders;

use App\Models\SocialWelfare;
use Illuminate\Database\Seeder;

class WelfareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $welfares = [
            'Charitable Trust',
            'Social ACT',
        ];

        foreach ($welfares as $value) {
            $model = SocialWelfare::whereName($value);
            if ($model->count() == 0) {
                SocialWelfare::create(['name' => $value]);
            }
        }
    }
}
