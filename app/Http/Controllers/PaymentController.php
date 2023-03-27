<?php

namespace App\Http\Controllers;

use App\Models\StudentDetails;
use App\Models\TransactionHistory;
use App\Models\UgExaminationApplication;
use App\Models\PgExaminationApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;


class PaymentController extends Controller
{
    public function payment_page($id)
    {
        

        

        $student = StudentDetails::find($id);


        
        
       return view('payment.index',compact('student','id'));
    }

    public function payment_post($id)
    {
       
        //$ug_app = UgExaminationApplication::where('stu_id',$id)->first('id');

        DB::table('ug_examination_applications')
              ->where('stu_id', $id)
              ->update(['payment_status' => 1]);

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $length = 22;
        $rand_chars = substr( str_shuffle( $chars ), 0, $length );
        $rand_chars = 'PAY'.$rand_chars;
        $paymentstatus = "success";
        $date = Carbon::now()->format('Y-m-d');
        $ug_app = UgExaminationApplication::where('stu_id',$id)->first(['id']);

        $app_id = $ug_app->id;
        $payment = new TransactionHistory();
        $payment->app_id = $app_id;
        $payment->transaction_type = 'ug';
        $payment->transaction_id = $rand_chars;
        $payment->amount = 15200;
        $payment->transaction_response = $paymentstatus;
        $payment->transaction_date = $date;
        $payment->save();

        return redirect()->route('student_app_preview',[$id]);

    }





    public function pg_payment_page($id)
    {
        

        

        $student = StudentDetails::find($id);


        
        
       return view('payment.pgpayment',compact('student','id'));
    }

    public function pg_payment_post($id)
    {
       
        //$ug_app = UgExaminationApplication::where('stu_id',$id)->first('id');

        DB::table('pg_examination_applications')
              ->where('stu_id', $id)
              ->update(['payment_status' => 1]);

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $length = 22;
        $rand_chars = substr( str_shuffle( $chars ), 0, $length );
        $rand_chars = 'PAY'.$rand_chars;
        $paymentstatus = "success";
        $date = Carbon::now()->format('Y-m-d');
        $pg_app = PgExaminationApplication::where('stu_id',$id)->first(['id']);

        $app_id = $pg_app->id;
        $payment = new TransactionHistory();
        $payment->app_id = $app_id;
        $payment->transaction_type = 'pg';
        $payment->transaction_id = $rand_chars;
        $payment->amount = 29300;
        $payment->transaction_response = $paymentstatus;
        $payment->transaction_date = $date;
        $payment->save();

        return redirect()->route('student_app_preview',[$id]);

    }
}
