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
        $template = template::query()->where('id', $id)->FirstOrFail();

        $name = $request->input('name');
        $header = $request->input('header');
        $points = $request->input('points');

        $template->name = $name ?? $template->name;
        $template->header = $header ?? $template->header;
        $template->points = $points ?? $template->points;

        $template->save();
        return $template->id;
    }
}
