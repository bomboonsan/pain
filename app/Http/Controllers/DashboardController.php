<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LineUser;
use App\Models\CasePain;
use App\Models\Record;

class DashboardController extends Controller
{
    public $positions_text = [
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

    public function dashboard()
    {
        $users = LineUser::all();
        return view('backend.dashboard' , compact('users'));
    }
    public function userShow($id)
    {
        $positions_text = $this->positions_text;
        $user = LineUser::where('id' , $id)->first();
        if(!$user) {
            return abort(404);
        }
        $cases = CasePain::where('user_id' , $user->id)
                        ->orderBy('updated_at', 'desc')
                        ->get();
        return view('backend.userShow' , compact('user' , 'cases' , 'positions_text'));
    }
    public function caseShow($id)
    {
        $positions_text = $this->positions_text;
        $case = CasePain::where('id' , $id)->first();
        if(!$case) {
            return abort(404);
        }
        $user = LineUser::where('id' , $case->user_id)->first();
        $records = Record::where('case_id' , $case->id)
                        ->orderBy('updated_at', 'desc')
                        ->get();
        return view('backend.caseShow' , compact('user' , 'case' , 'records' , 'positions_text'));
    }
}
