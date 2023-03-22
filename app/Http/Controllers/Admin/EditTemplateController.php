<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\template;
use Illuminate\Http\Request;

class EditTemplateController extends Controller
{
    public function index()
    {
        $templates = template::all();
        return view('admin.templates.EditTemplates', ['templates' => $templates]);
    }

    public function editTemplate(int $id)
    {
        $TemplateObject = template::where('id', $id)->FirstOrFail();
        return view('admin.templates.EditTemplate', ['Template' => $TemplateObject]);
    }

    public function store(Request $request, int $id)
    {
        $template = template::where('id', $id)->FirstOrFail();

        // Variables for get/post vars
        $name = $request->input('name');
        $header = $request->input('header');
        $points = $request->input('points');

        // Check if variables are null
        if ($name == null) return abort(400);
        if ($header == null) return abort(400);
        if ($points == null) return abort(400);

        // Update template model
        $template->name = $name;
        $template->header = $header;
        $template->points = $points;

        // Save model
        $template->save();
        return $template->id;
    }
}
