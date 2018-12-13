<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Winner;

class WinnerController extends Controller
{
    // CHECK NUMBER
    public function check_number($number)
    {
    	$n = Winner::where('number', $number)->first();

    	if(!emtpy($n)) {
    		return true;
    	}

    	return false;
    }


    // SAVE WINNING NUMBER TO DATABASE
    public function save_number($number)
    {
    	$n = new Winner();
    	$n->number = $number;
    	$n->save();
    }


    // ADD WINNER TO THE NUMBER
    public function add_winnder($id, $winner)
    {
    	$n = Winner::find($id);
    	$n->winner = $winner;
    	$n->save();
    }


    // ADD PRIZE TO THE NUMBER
    public function add_prize($id, $prize)
    {
    	$n = Winner::find($id);
    	$n->prize = $prize;
    	$n->save();
    }


    // GET ALL WINNING NUMBER WITH WINNER AND PRIZE
    public function get_winners()
    {
    	$winners = Winner::orderBy('id', 'asc')->get();

    	return $winners;
    }
}
