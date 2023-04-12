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
    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:400',
            'agendaItem_id' => 'required|int',
        ]);

        $data['comment'] = str_replace("\n", "<br>", $data['comment']);

        $comment = new Comment();

        $comment->user_id = Auth::user()->id;
        $comment->agenda_item_id = $data['agendaItem_id'];
        $comment->comment = $data['comment'];

        $comment->save();

        return redirect()->back();
    }
}
