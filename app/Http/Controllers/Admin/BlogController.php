<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'author'   => 'nullable|string|max:100',
            'summary'  => 'nullable|string',
            'content'  => 'required|string',
            'image'    => 'nullable|string|max:255',
        ]);

        $validated['slug']         = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['published_at'] = now();
        $validated['author']       = $validated['author'] ?? 'فريق Robotsoft';
        $validated['image']        = $validated['image']  ?? 'assets/logo.jpeg';

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'تم نشر المقال بنجاح.');
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'author'   => 'nullable|string|max:100',
            'summary'  => 'nullable|string',
            'content'  => 'required|string',
            'image'    => 'nullable|string|max:255',
        ]);

        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'تم تعديل المقال بنجاح.');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'تم حذف المقال بنجاح.');
    }
}
