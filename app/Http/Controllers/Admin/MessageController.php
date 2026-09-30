<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function markAsRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return back()->with('success', 'تم تحديد الرسالة كمقروءة.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'تم حذف الرسالة بنجاح.');
    }
}
