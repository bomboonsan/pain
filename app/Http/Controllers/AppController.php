<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// import model LineUser
use App\Models\LineUser;
use App\Models\CasePain;
use App\Models\Record;

class AppController extends Controller
{

    public function checkSession()
    {
        $profile = Session::get('profile');
        if (!$profile) {
            Session::forget('profile');
            Session::forget('positions');
            Session::forget('symptomsLevel');
            Session::forget('symptoms');
            Session::forget('medReceived');
            return redirect()->route('login');
        }
    }

    public $postions_text = [
        '1' => 'หัว',
        '2' => 'ไหล่ซ้าย',
        '3' => 'หน้าอก',
        '4' => 'ไหล่ขวา',
        '5' => 'ข้อศอกซ้าย',
        '6' => 'ข้อศอกขวา',
        '7' => 'เอวซ้าย',
        '8' => 'เอวขวา',
        '9' => 'มือซ้าย',
        '10' => 'มือขวา',
        '11' => 'ต้นขาซ้าย',
        '12' => 'ต้นขาขวา',
        '13' => 'หัวเข่าซ้าย',
        '14' => 'หัวเข่าขวา',
        '15' => 'น่องซ้าย',
        '16' => 'น่องขวา',
        '17' => 'เท้าซ้าย',
        '18' => 'เท้าขวา',
    ];

    public function login()
    {
        return view('app.login');
    }
    public function logout()
    {
        Session::forget('profile');
        return redirect()->route('login');
    }

    public function home()
    {

        $postions_text = [
            '1' => 'หัว',
            '2' => 'ไหล่ซ้าย',
            '3' => 'หน้าอก',
            '4' => 'ไหล่ขวา',
            '5' => 'ข้อศอกซ้าย',
            '6' => 'ข้อศอกขวา',
            '7' => 'เอวซ้าย',
            '8' => 'เอวขวา',
            '9' => 'มือซ้าย',
            '10' => 'มือขวา',
            '11' => 'ต้นขาซ้าย',
            '12' => 'ต้นขาขวา',
            '13' => 'หัวเข่าซ้าย',
            '14' => 'หัวเข่าขวา',
            '15' => 'น่องซ้าย',
            '16' => 'น่องขวา',
            '17' => 'เท้าซ้าย',
            '18' => 'เท้าขวา',
        ];

        $profile = Session::get('profile');
        if (!$profile) {
            return redirect()->route('login');
        }

        $user = LineUser::where('userId' , $profile->userId)->first();
        $cases = CasePain::where('user_id' , $user->id)
                        ->orderBy('updated_at', 'desc')
                        ->get();
        if(count($cases) == 0) {
            return redirect()->route('newPain');
        }

        $case_inprogress = CasePain::where('user_id' , $user->id)
                        ->where('status' , '!=' , 'finish')
                        ->first();
        if($case_inprogress) {
            $case_inprogress_id = $case_inprogress->id;
        } else {
            $case_inprogress_id = null;
        }


        $records = Record::where('case_id' , $cases->first()->id)
        ->orderBy('date', 'asc')
        // ->orderBy('date', 'desc')
            ->get();



        return view('app.home' , compact('user' , 'cases' , 'records' , 'postions_text' , 'case_inprogress_id'));
    }
    public function newPain()
    {
        Session::forget('positions');
        Session::forget('symptomsLevel');
        Session::forget('symptoms');
        Session::forget('medReceived');

        return redirect()->route('pain');

    }
    public function pain()
    {

        // $this->checkSession();

        // // reset session
        // Session::forget('positions');

        $positions = Session::get('positions');
        // dd($position);
        return view('app.pain' , compact('positions'));
    }
    public function painPost(Request $request)
    {

        if(empty($request->positions)) {
            return redirect()->back()->with('error' , 'กรุณาเลือกตำแหน่งที่ปวด');
        }


        $request->validate([
            'positions' => 'required',
        ]);
        Session::put('positions', $request->positions);


        return redirect()->route('symptoms');

    }
    public function symptoms()
    {

        $positions = Session::get('positions');
        if(empty($positions)) {
            return redirect()->route('pain');
        }

        $symptomsLevel = Session::get('symptomsLevel');
        if(empty($symptomsLevel)) {
            $symptomsLevel = 5;
        }

        return view('app.symptoms' , compact('symptomsLevel'));

    }
    public function symptomsPost(Request $request)
    {
        $request->validate([
            'symptomsLevel' => 'required',
        ]);
        Session::put('symptomsLevel', $request->symptomsLevel);
        return redirect()->route('symptomsSelect');
    }
    public function symptomsSelect()
    {

        $positions = Session::get('positions');
        if(empty($positions)) {
            return redirect()->route('pain');
        }

        $symptomsLevel = Session::get('symptomsLevel');
        if(empty($symptomsLevel)) {
            return redirect()->route('symptoms');
        }

        $symptomsSelected = Session::get('symptoms');
        if(empty($symptomsSelected)) {
            $symptomsSelected = [];
        }
        return view('app.symptoms-select' , compact('symptomsSelected'));
    }
    public function symptomsSelectPost(Request $request)
    {
        if(empty($request->symptoms)) {
            return redirect()->back()->with('error' , 'กรุณาเลือกอาการ');
        }

        $request->validate([
            'symptoms' => 'required',
        ]);
        Session::put('symptoms', $request->symptoms);
        return redirect()->route('received');
    }
    public function received()
    {
        return view('app.received');
    }
    public function receivedPost(Request $request)
    {
        $medReceived = Session::get('medReceived');
        if(empty($medReceived)) {
            return redirect()->back()->with('error' , 'กรุณาเลือกยาที่ได้รับ');
        }

        return redirect()->route('result');
    }
    public function result()
    {

        $profile = Session::get('profile');
        if (!$profile) {
            return redirect()->route('home');
        }

        $positions = Session::get('positions');
        $symptomsLevel = Session::get('symptomsLevel');
        $symptoms = Session::get('symptoms');
        $medReceived = Session::get('medReceived');

        if(empty($positions) || empty($symptomsLevel) || empty($symptoms) || empty($medReceived)) {
            return redirect()->route('pain');
        }

        // dd($positions , $symptomsLevel , $symptoms , $medReceived);

        foreach ($positions as $position) {
            $position_text = $this->postions_text[$position];
            $position_text_all[] = $position_text;
        }

        $symptoms_keys = array_keys($symptoms);
        $symptoms_text = [];
        foreach ($symptoms_keys as $key) {
            $symptoms_text[] = $key;
        }


        return view('app.result' , compact('position_text_all' , 'symptomsLevel' , 'symptoms_text' , 'medReceived'));
    }

    public function caseSubmit()
    {

        $profile = Session::get('profile');
        if (!$profile) {
            return redirect()->route('login');
        }

        $positions = Session::get('positions');
        $symptomsLevel = Session::get('symptomsLevel');
        $symptoms = Session::get('symptoms');
        $medReceived = Session::get('medReceived');

        // dd($positions , $symptomsLevel , $symptoms , $medReceived);

        $postions_value = array_values($positions);
        $positionString = implode(',' , $postions_value);
        // dd($positionString);


        $symptoms_key = array_keys($symptoms);
        $symptomsString = implode(',' , $symptoms_key);
        // dd($symptomsString);

        $medsList = [];
        foreach ($medReceived as $med) {
            $medsList[] = $med['name'];
        }
        $meds_value = array_values($medsList);
        $medsString = implode(',' , $meds_value);
        // dd($medsString);


        $user = LineUser::where('userId' , $profile->userId)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $user_id = $user->id;

        // 'positions',
        // 'level',
        // 'symptom',
        // 'meds',


        $case = CasePain::create([
            'user_id' => $user_id,
            'positions' => $positionString,
            'level' => $symptomsLevel,
            'symptom' => $symptomsString,
            'meds' => $medsString,
        ]);

        // add record

        $record = Record::create([
            'case_id' => $case->id,
            'level' => $symptomsLevel,
            'meds' => $medsString,
            'date' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success' , 'บันทึกข้อมูลเรียบร้อย');



        //

    }

    public function record()
    {
        $profile = Session::get('profile');
        if (!$profile) {
            return redirect()->route('login');
        }

        $user = LineUser::where('userId' , $profile->userId)->first();
        if (!$user) {
            return redirect()->route('login');
        }

        $cases = CasePain::where('user_id' , $user->id)
                        ->where('status' , '!=' , 'finish')
                        ->orderBy('updated_at', 'desc')
                        ->first();
        if (!$cases) {
            return redirect()->route('home');
        }


        return view('app.record' , compact('cases'));
    }
    public function recordPost(Request $request , $case_id)
    {



        $profile = Session::get('profile');
        if (!$profile) {
            return redirect()->route('login');
        }

        $user = LineUser::where('userId' , $profile->userId)->first();
        if (!$user) {
            return redirect()->route('login');
        }
        $user_id = $user->id;


        $case = CasePain::where('id' , $case_id)->first();
        if(!$case) {
            return redirect()->route('home');
        }

        if($case->user_id != $user_id) {
            // show 404
            return redirect()->route('home');
        }

        $request->validate([
            'meds' => 'required',
            'date' => 'required',
            'symptomsLevel' => 'required',
        ]);

        if(empty($request->meds)) {
            return redirect()->back()->with('error' , 'กรุณาเลือกยา');
        }

        $meds_key = array_keys($request->meds);
        $medsString = implode(',' , $meds_key);

        if(!empty($request->meds_add) && !empty($request->meds_add_input) && $request->meds_add == 'on')
        {
            $medsString = $medsString . ',' . $request->meds_add_input;

            // update data in Case -> meds
            $oldMeds = $case->meds;
            $case->meds = $oldMeds . ',' . $request->meds_add_input;
            $case->save();

        }


        $level = $request->symptomsLevel;
        $meds = $medsString;
        $date = $request->date;


        $record = Record::create([
            'case_id' => $case_id,
            'level' => $level,
            'meds' => $meds,
            'date' => $date,
        ]);

        return redirect()->back()->with('success' , 'บันทึกข้อมูลเรียบร้อย');
    }

    public function report($id)
    {

        $profile = Session::get('profile');
        if (!$profile) {
            return redirect()->route('login');
        }

        $user = LineUser::where('userId' , $profile->userId)->first();
        if (!$user) {
            return redirect()->route('login');
        }
        $user_id = $user->id;


        $case = CasePain::where('id' , $id)->first();
        if(!$case) {
            return redirect()->route('home');
        }

        // check column user_id == $user_id

        if($case->user_id != $user_id) {
            // show 404
            return abort(404);

        }

        $records = Record::where('case_id' , $id)
        ->orderBy('date', 'asc')
        ->get();

        $levelRecords = [];

        foreach ($records as $record) {
            $levelRecords[] = $record->level;
        }

        // dd($levelRecords , $records_data);




        return view('app.report' , compact('case' , 'records' , 'levelRecords'));
    }
    public function finishCase(Request $request , $case_id)
    {

        $case = CasePain::where('id' , $case_id)
                ->where('status' , '!=' , 'finish')
                ->first();
        if(!$case) {
            return redirect()->route('home');
        }

        $case->status = 'finish';
        $case->save();

        return redirect()->route('home')->with('success' , 'บันทึกข้อมูลเรียบร้อย');

    }
    public function reportDemo()
    {
        return view('app.report-demo');
    }
}
