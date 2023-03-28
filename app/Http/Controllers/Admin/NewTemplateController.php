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


        $name = $request ->input('name');
        $header = $request -> input('header');
        $points = $request -> input('points');

        $template -> name = $name;
        $template -> header = $header;
        $template -> points = $points;
        $template->user_id = $UserId;
        $template->save();

        return to_route('EditTemplates');
    }
}
