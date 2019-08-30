<?php

namespace App\Http\Controllers;

use App\Http\Requests\BmrRequest;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function bmr()
    {
        return view('tools.bmr');
    }

    public function bmresults(BmrRequest $request)
    {
        if($request->sex == 'Male') {
            $bmr = (int)(66 + (13.7 * $request->weight) + (5 * $request->height) - (6.8 * $request->age));
        }
        else {
            $bmr = (int)(655 + (9.6 * $request->weight) + (1.9 * $request->height) - (4.7 * $request->age));
        }

        if($request->activity == 'sedentary') {
            $bmr = (int)($bmr *1.2);
        }
        else if($request->activity == 'lightly active') {
            $bmr = (int)($bmr *1.375);
        }
        else if($request->activity == 'moderately active') {
            $bmr = (int)($bmr *1.55);
        }
        else if($request->activity == 'very active') {
            $bmr = (int)($bmr *1.725);
        }
        else if($request->activity == 'extra active') {
            $bmr = (int)($bmr *1.9);
        }

        $bmi = ( $request->weight / pow(($request->height/100), 2));
        if($bmi < 18){

            $bmiStatus = "underweight";

        }elseif ($bmi>=18 && $bmi<25){

            $bmiStatus = "normal";

        }elseif ($bmi>=25 && $bmi<30){

            $bmiStatus = "overweight";

        }elseif($bmr>= 30){

            $bmiStatus = "obese";

        }

        $bmi = number_format($bmi, 2);
        return view('tools.bmr', compact('bmr', 'bmi', 'bmiStatus'));
    }

    public function track(Request $request)
    {
        $this->validate(request(), [
           'target' => 'required',
            'days' => 'required',
            'maintain' => 'required'
        ]);

        $burnStatus = 7700 * $request['target'];

        $deficit =  (int) ($burnStatus / $request['days']);
        $deficit = $request['maintain'] - $deficit;

        return view('tools.bmr', compact('deficit', 'burnStatus'));
    }

    public function diary()
    {
        return view ('tools.diary');
    }

    public function planner()
    {
        return view ('tools.planner');
    }

    public function counter()
    {
        return view ('tools.counter');
    }

}
