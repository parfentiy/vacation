<?php

namespace App\Http\Controllers;
use App\Models\Vacation;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class VacationController extends Controller
{
    public function showVacations() {
        dump(Auth::user()->id);
        //dd(request());
        //$query = (Auth::user()->is_admin) ? Vacation::all() : Vacation::where('user_id', Auth::user()->id)->get();

        return view('my-vacations', [
            'myVacations' => (Auth::user()->is_admin) ? Vacation::all() : Vacation::where('user_id', Auth::user()->id)->get(),
        ]);

    }

    public function saveVacation() {
        //dd(request());
        Vacation::create([
            'start_date' => request()->start_date,
            'end_date' => request()->end_date,
            'user_id' => request()->user_id,
            'is_confirmed' => false,
        ]);

        return view('my-vacations', [
            'myVacations' => (Auth::user()->is_admin) ? Vacation::all() : Vacation::where('user_id', Auth::user()->id)->get(),
        ]);

    }

    public function updateVacation() {
        //dd(request());

        $vacation = Vacation::where('id', request()->vacation_id)->first();
        $vacation->start_date = request()->start_date;
        $vacation->end_date = request()->end_date;
        $vacation->user_id = request()->user_id;
        $vacation->is_confirmed = (request()->is_confirmed === "true") ? true : false;

        $vacation->save();

        return view('my-vacations', [
            'myVacations' => (Auth::user()->is_admin) ? Vacation::all() : Vacation::where('user_id', Auth::user()->id)->get(),
        ]);

    }

    public function deleteVacation() {
        Vacation::where('id', request()->vacation_id)->delete();

        return view('my-vacations', [
            'myVacations' => (Auth::user()->is_admin) ? Vacation::all() : Vacation::where('user_id', Auth::user()->id)->get(),
        ]);
    }   
}
