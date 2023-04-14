<?php

namespace App\Http\Controllers;

use App\Models\AgendaItem;
use App\Models\Comment;
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
    public function confirmation($id)
    {
        if (!is_numeric($id))
            abort(404);

        $agendaItem = AgendaItem::find($id);

        if (!$agendaItem)
            abort(404);

        if ($agendaItem->user_id !== Auth::user()->id)
            abort(403);

        return view('agenda-item.agendaItemDelConfirm', [
            'id' => $agendaItem->id
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

        $data['content'] = str_replace("\r\n", "<br>", $data['content']);

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

        $data['content'] = str_replace("\r\n", "<br>", $data['content']);

        $agendaItem = AgendaItem::find($data['id']);

        if ($agendaItem->user_id !== Auth::user()->id)
            abort(403);

        $agendaItem->content = $data['content'];
        $agendaItem->category = $data['category'];
        $agendaItem->finish_date = $data['planned_time'];

        $agendaItem->save();

        return redirect("/meeting/$agendaItem->meeting_id");
    }

    public function delete(Request $request)
    {
        $data = $request->validate([
            'id' => 'int|required',
        ]);

        $agendaItem = AgendaItem::find($data['id']);

        if (!$agendaItem)
            abort(404);

        if ($agendaItem->user_id !== Auth::user()->id)
            abort(403);

        $meeting_id = $agendaItem->meeting->id;

        $agendaItem->delete();

        return redirect("meeting/$meeting_id");
    }
}
