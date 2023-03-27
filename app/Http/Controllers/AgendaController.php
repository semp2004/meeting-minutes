<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\template;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Agenda;


class AgendaController extends Controller
{
    public function index()
    {
        return view('agenda.agenda', [
            'meetings' => Meeting::all(),
        ]);
    }

    public function meeting(Meeting $Meeting)
    {
        return view('meetings.meeting', [
            'meeting' => $Meeting
        ]);
    }

    public function newmeeting()
    {

        return view('meetings.newmeeting', [
            'users' => User::get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'planned_time' => 'required|date',
            'meeting_participants' => 'required|string|max:255',
        ]);

        $agenda = new Meeting();
        $agenda->name = $data['name'];
        $agenda->planned_time = $data['planned_time'];
        $agenda->meeting_participants = $data['meeting_participants'];
        $agenda->user_id = auth()->user()->id;
        $agenda->save();

        return redirect('/agenda')->with('success', 'Meeting is toegevoegd!');
    }

}
