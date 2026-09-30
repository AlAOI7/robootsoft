<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'phone'    => 'nullable|string|max:50',
            'role'     => 'required|string|in:admin,moderator,user',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['status']   = 'active';

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:50',
            'role'     => 'required|string|in:admin,moderator,user',
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم تعديل المستخدم بنجاح.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الحالي!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }
}
