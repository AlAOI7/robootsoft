<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|string|max:255',
            'industry'    => 'nullable|string|max:100',
            'testimonial' => 'nullable|string',
            'rating'      => 'nullable|integer|min:1|max:5',
        ]);

        $validated['logo']   = $validated['logo']   ?? 'assets/logo.jpeg';
        $validated['rating'] = $validated['rating'] ?? 5;

        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'تمت إضافة العميل بنجاح.');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|string|max:255',
            'industry'    => 'nullable|string|max:100',
            'testimonial' => 'nullable|string',
            'rating'      => 'nullable|integer|min:1|max:5',
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'تم تعديل بيانات العميل بنجاح.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'تم حذف العميل بنجاح.');
    }
}
