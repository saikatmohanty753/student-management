<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin',
            'College',
            'Student',
            'Temp-College',
            'Academic-Cell',
            'Secretary-OLLC',
            'Registrar',
            'Academic-Section',
            'Student-Portal',
            'Exam-Section',
            'College-Exam-Section',
            'College-Academic-Section',
        ];

        foreach ($roles as $role) {
            $model = Role::whereName($role);
            if ($model->count() == 0) {
                Role::create(['name' => $role, 'guard_name' => 'web']);
            }
        }
    }
}
