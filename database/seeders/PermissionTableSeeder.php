<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-module',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-module',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'college-module',
            'college-list',
            'college-create',
            'college-edit',
            'college-delete',

            'course-module',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',

            'master-module',
            'master-list',
            'master-create',
            'master-edit',
            'master-delete',

            'college-info-module',
            'college-info-list',
            'college-info-create',
            'college-info-edit',
            'college-info-delete',

            'registered-college-module',
            'registered-college-list',
            'registered-college-create',
            'registered-college-edit',
            'registered-college-delete',

            'noc-college-module',
            'noc-college-list',
            'noc-college-create',
            'noc-college-edit',
            'noc-college-delete',

            'uuc-affiliation-module',
            'uuc-affiliation-list',
            'uuc-affiliation-create',
            'uuc-affiliation-edit',
            'uuc-affiliation-delete',

            'academic-affiliation-module',
            'academic-affiliation-list',
            'academic-affiliation-create',
            'academic-affiliation-edit',
            'academic-affiliation-delete',

            'registrar-affiliation-module',
            'registrar-affiliation-list',
            'registrar-affiliation-create',
            'registrar-affiliation-edit',
            'registrar-affiliation-delete',

            'notice-module',
            'notice-list',
            'notice-create',
            'notice-edit',
            'notice-delete',

            'college-notice-module',
            'college-notice-list',
            'college-notice-create',
            'college-notice-edit',
            'college-notice-delete',

            'semester-module',
            'semester-list',
            'semester-create',
            'semester-edit',
            'semester-delete',

            'paper-module',
            'paper-list',
            'paper-create',
            'paper-edit',
            'paper-delete',

            'syllabus-module',
            'syllabus-list',
            'syllabus-create',
            'syllabus-edit',
            'syllabus-delete',

            'department-module',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete',

            'verify-admission-module',
            'verify-admission-list',
            'verify-admission-create',
            'verify-admission-edit',
            'verify-admission-delete',

            'admission-module',
            'admission-list',
            'admission-create',
            'admission-edit',
            'admission-delete',

            'credit-module',
            'credit-list',
            'credit-create',
            'credit-edit',
            'credit-delete',

            'uuc-student-module',
            'uuc-student-list',
            'uuc-student-create',
            'uuc-student-edit',
            'uuc-student-delete',

            'student-module',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',

            'course-maped-module',
            'course-maped-list',
            'course-maped-create',
            'course-maped-edit',
            'course-maped-delete',

            'course-structure-module',
            'course-structure-list',
            'course-structure-create',
            'course-structure-edit',
            'course-structure-delete',

            'student-details-module',
            'student-details-list',
            'student-details-create',
            'student-details-edit',
            'student-details-delete',

            'uuc-pg-admission-module',
            'uuc-pg-admission-list',
            'uuc-pg-admission-create',
            'uuc-pg-admission-edit',
            'uuc-pg-admission-delete'

        ];
        foreach ($permissions as $permission) {
            // $permission = Permission::create(['guard_name' => 'admin', 'name' => $permission]);

            $model = Permission::whereName($permission);
            if ($model->count() == 0) {
                Permission::create(['name' => $permission]);
                // $permission = Permission::create(['guard_name' => 'admin', 'name' => $permission]);
            }

        }
    }
}
