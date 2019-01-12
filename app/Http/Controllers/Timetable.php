<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class Timetable extends Controller
{
   	public function show(Request $request) {
   		$group = $request->user()->student()->get_group();
   		$lessons = [];
		$days = ["Monday", "Tuesday", "Wednesday", "Thirsday", "Friday", "Saturday"];
		foreach($days as $day) {
			$lessons[$day] = Lesson::where("weekday", $day)->where("group", $group)->orderBy("number")->get();
		}
   		return view("timetable", ["lessons" => $lessons, "group" => $group]);
   	} 
}
