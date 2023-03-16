<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\template;
use Illuminate\Http\Request;

class NewTemplateController extends Controller
{
    public function index()
    {
        return view('admin.templates.NewTemplate');
    }

    public function store(Request $request){
        $UserId = \Auth::id();
        $template = new template();
        $template->content = $request->input('content');
        $template->user_id = $UserId;
        $template->save();
        return $template -> id;
    }
}
