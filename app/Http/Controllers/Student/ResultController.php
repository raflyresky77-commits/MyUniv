<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function index()
    {
        $minatResult = session('minat_bakat_result');
        $kemampuanResult = session('kemampuan_result');
        $kepribadianResult = session('kepribadian_result');

        $assessmentCompleted =
            is_array($minatResult) && count($minatResult) > 0 &&
            is_array($kemampuanResult) && count($kemampuanResult) > 0 &&
            is_array($kepribadianResult) && count($kepribadianResult) > 0;

        return view('student.assessment.result', compact(
            'minatResult',
            'kemampuanResult',
            'kepribadianResult',
            'assessmentCompleted'
        ));
    }
}
