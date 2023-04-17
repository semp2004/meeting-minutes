<?php

namespace App\Http\Controllers;

use App\Models\Actionpoint;
use App\Models\User;
use Illuminate\Http\Request;

class ActionItemController extends Controller
{
    public function add(string $agendaItem)
    {
        return view('action-points.actionItem', [
            'users' => User::get(),
            'agendaItem' => $agendaItem,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|int',
            'assigned_to' => 'required|int',
            'title'=> 'required|string|max:255',
            'content' => 'required|string|max:400',
            'assigned_date' => 'required|date',
        ]);

        $NewPoint = new Actionpoint();
        $NewPoint->agenda_item_id = $data['id'];
        $NewPoint->assigned_to = $data['assigned_to'];
        $NewPoint->user_id = auth()->user()?->id;
        $NewPoint->title = $data['title'];
        $NewPoint->content = $data['content'];
        $NewPoint->assigned_date = $data['assigned_date'];
        $NewPoint->save();

        return redirect()->route('dashboard');

    }
}
