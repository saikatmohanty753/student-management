<?php

namespace Database\Seeders;

use App\Models\AffiliationType;
use Illuminate\Database\Seeder;

class AffiliationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Permanent',
            'Temporary ',
            'Renewal',

        ];
        foreach ($types as $type) {
            $model = AffiliationType::whereType($types);
            if ($model->count() == 0) {
                AffiliationType::create(['type' => $type]);
            }
        }
    }
}
