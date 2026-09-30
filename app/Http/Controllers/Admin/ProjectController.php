<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'category'        => 'nullable|string|max:100',
            'client_name'     => 'nullable|string|max:255',
            'image'           => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'link'            => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'is_featured'     => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['image']       = $validated['image'] ?? 'assets/logo.jpeg';

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'تمت إضافة المشروع بنجاح.');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'category'        => 'nullable|string|max:100',
            'client_name'     => 'nullable|string|max:255',
            'image'           => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'link'            => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'is_featured'     => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'تم تعديل المشروع بنجاح.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'تم حذف المشروع بنجاح.');
    }
}
