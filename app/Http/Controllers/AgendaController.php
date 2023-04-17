<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Meeting;
use App\Models\MeetingParticipants;
use App\Models\User;
use Illuminate\Http\Request;


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
        $persons = $Meeting->persons;
        return view('meetings.meeting', [
            'meeting' => $Meeting,
            'persons' => $persons,
            'agendaItems' => $Meeting->agendaItems,
            'actionItem' => $Meeting->actionItems
        ]);
    }

    public function newmeeting()
    {

        return view('meetings.newMeeting', [
            'users' => User::get(),
        ]);
    }

    public function editmeeting(Meeting $Meeting)
    {
        $persons = $Meeting->persons;
        return view('meetings.editMeeting', [
            'users' => User::get(),
            'meeting' => $Meeting,
            'persons' => $persons,
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

    public function update(Request $request, Meeting $Meeting)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'planned_time' => 'required|date',
            'meeting_participants' => 'required|array|max:255',
        ]);

        $Meeting->name = $data['name'];
        $Meeting->planned_time = $data['planned_time'];
        $Meeting->save();

        $Meeting->persons()->detach();
        foreach ($request->meeting_participants as $meeting_participant) {
            $mp = new MeetingParticipants();
            $mp->meeting_id = $Meeting->id;
            $mp->user_id = $meeting_participant;
            $mp->save();
        }

        return redirect('/agenda')->with('success', 'Meeting is aangepast!');
    }

    public function delete(Meeting $Meeting)
    {
        $Meeting->delete();
        return redirect('/agenda')->with('success', 'Meeting is verwijderd!');
    }

}
