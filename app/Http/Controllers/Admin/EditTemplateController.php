<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;

class EditTemplateController extends Controller
{
    public function index(int $id)
    {
        $TemplateObject = template::where('id', $id) -> FirstOrFail();
        return view('admin.EditTemplate', ['template' => $TemplateObject -> content]);
    }

    public function store(Request $request, int $id) {
        $template = template::where('id', $id) -> FirstOrFail();

        $template->content = $request->input('content');

        $template->save();
        return $template -> id;
    }
}
