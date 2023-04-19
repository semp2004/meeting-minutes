<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\TemplateTopic;
use Illuminate\Http\Request;

class EditTemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return view('admin.templates.EditTemplates', ['templates' => $templates]);
    }

    public function editTemplate(int $id)
    {
        $TemplateObject = Template::where('id', $id)->FirstOrFail();
        return view(view: 'admin.templates.EditTemplate', data: ['Template' => $TemplateObject]);
    }

    public function store(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'header' => 'required|string',
            'topics' => 'required|string',
        ]);

        $topics = explode("\r\n", $data['topics']);

        $template = Template::where('id', $id)->FirstOrFail();

        $template->name = $data['name'];
        $template->header = $data['header'];

        $template->save();

        foreach (TemplateTopic::where('template_id', $template->id)->get() as $topic)
        {
            if (count($topic->agendaItems) !== 0)
                return $this->index();
        }

        TemplateTopic::where('template_id', $template->id)->delete();
        foreach ($topics as $topic) {
            if (!empty($topic)) {
                $templateTopic = new TemplateTopic();

                $templateTopic->template_id = $template->id;
                $templateTopic->topic = $topic;

                $templateTopic->save();
            }
        }

        return $this->index();
    }
}
