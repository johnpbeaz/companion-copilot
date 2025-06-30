<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TemplateController extends Controller
{

    use AuthorizesRequests;
    
    public function index()
    {
        $templates = Auth::user()->templates()->latest()->get();
        return view('templates.index', compact('templates'));
    }

    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'json_config' => 'required|json',
        ]);

        Auth::user()->templates()->create($request->only('name', 'description', 'json_config'));

        return redirect()->route('templates.index')->with('success', 'Template saved.');
    }

    public function edit(Template $template)
    {
        $this->authorize('update', $template);
        return view('templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $this->authorize('update', $template);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'json_config' => 'required|json',
        ]);

        $template->update($request->only('name', 'description', 'json_config'));

        return redirect()->route('templates.index')->with('success', 'Template updated.');
    }

    public function destroy(Template $template)
    {
        $this->authorize('delete', $template);
        $template->delete();

        return back()->with('success', 'Template deleted.');
    }

    public function download(Template $template, string $format)
    {
        $this->authorize('view', $template);

        $ext = $format === 'companionconfig' ? 'companionconfig' : 'json';
        return response($template->json_config)
            ->header('Content-Type', 'application/json')
            ->header('Content-Disposition', "attachment; filename={$template->name}.{$ext}");
    }
}
