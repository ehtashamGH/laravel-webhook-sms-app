<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    public function index()
    {
        $templates = MessageTemplate::all();
        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message_id' => 'required|string|unique:message_templates,message_id',
            'subject' => 'nullable|string',
            'body' => 'required|string',
        ]);

        MessageTemplate::create($validated);

        return redirect()->route('templates.index')
            ->with('success', 'Template created successfully.');
    }

    public function show(MessageTemplate $template)
    {
        return view('admin.templates.show', compact('template'));
    }

    public function edit(MessageTemplate $template)
    {
        return view('admin.templates.edit', compact('template'));
    }

    public function update(Request $request, MessageTemplate $template)
    {
        $validated = $request->validate([
            'message_id' => 'required|string|unique:message_templates,message_id,' . $template->id,
            'subject' => 'nullable|string',
            'body' => 'required|string',
        ]);

        $template->update($validated);

        return redirect()->route('templates.index')
            ->with('success', 'Template updated successfully.');
    }

    public function destroy(MessageTemplate $template)
    {
        $template->delete();

        return redirect()->route('templates.index')
            ->with('success', 'Template deleted successfully.');
    }
}
