<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\TemplateTopic;
use Illuminate\Http\Request;

class NewTemplateController extends Controller
{
    public function index()
    {
        return view('admin.templates.NewTemplate');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'header' => 'required|string',
            'topics' => 'required|string',
        ]);

        $UserId = \Auth::id();
        $topics = explode("\r\n", $data['topics']);

        $template = new Template();

        $template->name = $data['name'];
        $template->header = $data['header'];
        $template->user_id = $UserId;

        $template->save();

        foreach ($topics as $topic) {
            $templateTopic = new TemplateTopic();

            $templateTopic->template_id = $template->id;
            $templateTopic->topic = $topic;

            $templateTopic->save();
        }

        return to_route('EditTemplates');
    }
}
