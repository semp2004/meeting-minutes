<?php

namespace App\Http\Controllers;

use App\Models\AgendaItem;
use Illuminate\Http\Request;

class AgendaItemController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:125',
            'content' => 'required|string|max:200',
            'planned_time' => 'required|date',
            'id' => 'required|int',
        ]);

        $data['content'] = str_replace("\n", "<br>", $data['content']);

        $agendaItem = new AgendaItem();
        $agendaItem->content = $data['content'];
        $agendaItem->category = $data['category'];
        $agendaItem->finish_date = $data['planned_time'];

        $agendaItem->meeting_id = $data['id'];
        $agendaItem->user_id = auth()->user()->id;

        $agendaItem->save();

        return redirect("/meeting/{$data['id']}");
    }
}
