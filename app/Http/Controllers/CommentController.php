<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // public function store(Request $request) {
    //     $data = $request->validate([
    //
    //     ]);
    //
    // }
    public function edit($id)
    {
        if (!is_numeric($id))
            abort(404);

        $comment = Comment::find($id);

        if (!$comment)
            abort(404);

        if ($comment->user_id !== Auth::user()->id)
            abort(403);

        return view('comments.editComment', [
            'comment' => $comment,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:400',
            'agendaItem_id' => 'required|int',
        ]);

        $data['comment'] = str_replace("\r\n", "<br>", $data['comment']);

        $comment = new Comment();

        $comment->user_id = Auth::user()->id;
        $comment->agenda_item_id = $data['agendaItem_id'];
        $comment->comment = $data['comment'];

        $comment->save();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:400',
            'id' => 'required|int',
        ]);

        $data['comment'] = str_replace("\r\n", "<br>", $data['comment']);

        $comment = Comment::find($data['id']);

        if (!$comment)
            abort(404);

        if ($comment->user_id !== Auth::user()->id)
            abort(403);

        $comment->comment = $data['comment'];

        $comment->save();

        return redirect()->back();
    }
    public function confirmation($id)
    {
        $comment = Comment::find($id);

        if (!$comment)
            abort(404);

        if ($comment->user_id !== Auth::user()->id)
            abort(403);

        return view('comments.commentDeleteConfirm', [
            'id' => $id,
        ]);
    }
    public function delete(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|int'
        ]);

        $comment = Comment::find($data['id']);

        if (!$comment)
            abort(404);

        if ($comment->user_id !== Auth::user()->id)
            abort(403);

        $meeting_id = $comment->agendaItem->topic->template->meeting->id;

        $comment->delete();

        return redirect("/meeting/" . $meeting_id);
    }
}
