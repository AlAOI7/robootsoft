<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (!empty($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'تمت إضافة الخدمة بنجاح.');
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if (!empty($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'تم تعديل الخدمة بنجاح.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخدمة بنجاح.');
    }
}
