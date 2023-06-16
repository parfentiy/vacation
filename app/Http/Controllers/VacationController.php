<?php

namespace App\Http\Controllers;
use App\Models\Vacation;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class VacationController extends Controller
{
    public function showVacations() {
        //dump(Auth::user()->id);

        return view('my-vacations', [
            'myVacations' => Vacation::where('user_id', Auth::user()->id)->get(),
        ]);

    }
    public function saveVacation() {
        // dd(request());
        Vacation::create([
            'start_date' => request()->start_date,
            'end_date' => request()->end_date,
            'user_id' => request()->user_id,
            'is_confirmed' => false,
        ]);

        return redirect()->back();
    }
}
