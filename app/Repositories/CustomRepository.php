<?php
namespace App\Repositories;
use App\Interfaces\CustomInterface;
use Illuminate\Support\Facades\Crypt;
use App\Models\StudentApplication;
use Carbon\Carbon;
use DB;

class CustomRepository implements CustomInterface{

    public function genAppNo($course='',$exist_app_no='')
    {

        $applicaton_no = '';
        $appInfo       = array('application_no' => '', 'app_count_no' => '');
        $course_data = DB::table('courses')->where('id',$course);
        if(!$course_data->exists())
        {
            return $appInfo;
        }
        $course_data = $course_data->first();
        define('APP_CODE',$course_data->main_course_code);
        $desipline_code = explode($course_data->main_course_code.'_',$course_data->sub_course_code);
        $desi_code = '';
        if(empty($desipline_code[1]))
        {
            $desi_code = 'NO';
        }else{
            $desi_code = $desipline_code[1];
        }
        if (!empty($exist_app_no)) {
            $appnew   = StudentApplication::where('application_no', $exist_app_no)->first();
            $newCount = (int) $appnew->app_count_no;
            if ($newCount < 999) {
                $newCount = $this->getNumApp($newCount + 1);
            } else {
                $newCount = $newCount + 1;
            }
            $applicaton_no = APP_CODE . $this->genBatch(). $desi_code . $newCount;
            $appnew        = StudentApplication::where('application_no', $applicaton_no);
            if (!$appnew->exists()) {
                $appInfo['application_no'] = $applicaton_no;
                $appInfo['app_count_no']  = $newCount;
                return $appInfo;
            } else {
                $this->generateExpApp($course,$applicaton_no);
            }
        } else {
            $app = StudentApplication::orderBy('id', 'desc')->whereNotNull('application_no')->first();
            if (!empty($app->app_count_no)) {
                $newCount = (int) $app->app_count_no;
                if ($newCount < 999) {
                    $newCount = $this->getNumApp($newCount + 1);
                } else {
                    $newCount = $newCount + 1;
                }
                $applicaton_no = APP_CODE . $this->genBatch() . $desi_code . $newCount;
                $check         = StudentApplication::where('application_no', $applicaton_no);
                if ($check->exists()) {
                    $this->generateExpApp($course,$applicaton_no);
                } else {
                    $appInfo['application_no'] = $applicaton_no;
                    $appInfo['app_count_no']  = $newCount;
                    return $appInfo;
                }
            } else {
                $applicaton_no            = APP_CODE . $this->genBatch() . $desi_code . '0001';
                $appInfo['application_no'] = $applicaton_no;
                $appInfo['app_count_no']  = '0001';
                return $appInfo;
            }
        }
    }
    public function getCurrFinancialYr()
    {
        if (date('m') <= 6) {
            $financial_year = (date('y') - 1) . date('y');
        } else {
            $financial_year = date('y') . (date('y') + 1);
        }
        return $financial_year;
    }

    public function getMonth()
    {
        if ((int) date('m') < 10) {
            $month = '0' . ((int) date('m'));
        } else {
            $month = date('m');
        }
        return $month;
    }

    public function getNumApp(int $num)
    {
        $num    = (string) $num;
        $strlen = strlen($num);
        $newnum = '';
        for ($i = 0; $i < (4 - $strlen); $i++) {
            $newnum .= '0';
        }
        $newnum .= (int) $num;
        return $newnum;
    }
    public function genBatch()
    {
        $year2 = Carbon::now()->addYear(2);
        $year = date('y', strtotime($year2));
        return date('y'). $year;
    }
    public function encrypt($str)
    {
        return Crypt::encryptString($str);
    }

    public function decrypt($str)
    {
        return Crypt::decryptString($str);
    }
}
