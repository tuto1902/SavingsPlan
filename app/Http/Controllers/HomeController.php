<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $monthlyGoals = Item::select('goal_id', DB::raw('SUM(amount) as amount'))->groupBy('goal_id')->get();
        $goals = [
            '1' => 0,
            '2' => 0,
            '3' => 0,
        ];
        foreach($monthlyGoals as $goal) {
            $goals[$goal->goal_id] = $goal->amount * 12 * 25;
        }
        return view('home.index', ['goals' => $goals]);
    }
}
