<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingParticipants;
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
        $persons = $Meeting ->persons();
        return view('meetings.meeting', [
            'meeting' => $Meeting,
            'persons' => $persons,
            'agendaItems' => $Meeting->agendaItems(),
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
            'meeting_participants' => 'required|array|max:255',
        ]);

        $agenda = new Meeting();
        $agenda->name = $data['name'];
        $agenda->planned_time = $data['planned_time'];

        $agenda->user_id = auth()->user()->id;
        $agenda->save();

        foreach ($request->meeting_participants as $meeting_participant) {
            $mp = new MeetingParticipants();
            $mp->meeting_id = $agenda->id;
            $mp->user_id = $meeting_participant;
            $mp->save();
        }

        return redirect('/agenda')->with('success', 'Meeting is toegevoegd!');

    }

}
