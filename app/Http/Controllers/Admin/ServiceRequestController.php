<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::latest()->paginate(15);
        return view('admin.service-requests.index', compact('requests'));
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:جديد,قيد المتابعة,مكتمل,ملغي',
        ]);

        $serviceRequest->update($validated);
        return back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();
        return redirect()->route('admin.service-requests.index')->with('success', 'تم حذف الطلب بنجاح.');
    }
}
