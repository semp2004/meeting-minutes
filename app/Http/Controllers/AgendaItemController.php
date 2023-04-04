<?php

namespace App\Http\Controllers;

use App\Models\AgendaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaItemController extends Controller
{
    public function edit(AgendaItem $agendaItem)
    {
        if (Auth::user()->id !== $agendaItem->user_id)
            abort(403);

        return view('agenda-item.EditAgendaItem', [
            'agendaItem' => $agendaItem,
        ]);
    }
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
    public function update(Request $request/*, AgendaItem $agendaItem*/)
    {
        $data = $request->validate([
            'category' => 'required|string|max:125',
            'content' => 'required|string|max:200',
            'planned_time' => 'required|date',
            'id' => 'required|int',
        ]);

        $agendaItem = AgendaItem::find($data['id']);

        if ($agendaItem->user_id !== Auth::user()->id)
            abort(403);

        $agendaItem->content = $data['content'];
        $agendaItem->category = $data['category'];
        $agendaItem->finish_date = $data['planned_time'];

        $agendaItem->save();

        return redirect("/meeting/$agendaItem->meeting_id");
    }
}
