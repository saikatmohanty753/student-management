<?php

namespace App\Interfaces;

interface CustomInterface{
    public function genAppNo($course='',$exist_app_no='');

    public function encrypt($str);

    public function decrypt($str);
}
