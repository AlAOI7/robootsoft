<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Client;
use App\Models\BlogPost;
use App\Models\Setting;
use App\Models\ContactMessage;
use App\Models\ServiceRequest;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $projects = Project::where('is_featured', true)->latest()->take(6)->get();
        $clients = Client::latest()->take(8)->get();
        $posts = BlogPost::latest('published_at')->take(3)->get();

        return view('home', compact('services', 'projects', 'clients', 'posts'));
    }

    public function about()
    {
        $clients = Client::latest()->take(8)->get();
        return view('about', compact('clients'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('services', compact('services'));
    }

    public function projects(Request $request)
    {
        $query = Project::query();
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        $projects = $query->latest()->get();
        return view('projects', compact('projects'));
    }

    public function clients()
    {
        $clients = Client::latest()->get();
        return view('clients', compact('clients'));
    }

    public function blog(Request $request)
    {
        $query = BlogPost::query();
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('summary', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        $posts = $query->latest('published_at')->paginate(6);
        return view('blog', compact('posts'));
    }

    public function blogPost($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        $post->increment('views_count');
        $relatedPosts = BlogPost::where('id', '!=', $post->id)->latest('published_at')->take(3)->get();
        return view('blog-single', compact('post', 'relatedPosts'));
    }

    public function faq()
    {
        return view('faq');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:5',
        ]);

        ContactMessage::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم استلام رسالتك بنجاح! سيتواصل معك فريقنا في أقرب وقت.'
            ]);
        }

        return back()->with('success', 'تم استلام رسالتك بنجاح! سيتواصل معك فريقنا في أقرب وقت.');
    }

    public function requestService()
    {
        $services = Service::where('is_active', true)->get();
        return view('request-service', compact('services'));
    }

    public function submitServiceRequest(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'service_type' => 'required|string|max:255',
            'system_size' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        ServiceRequest::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تقديم طلب الخدمة بنجاح! سيتواصل معك مستشارنا الفني قريباً.'
            ]);
        }

        return back()->with('success', 'تم تقديم طلب الخدمة بنجاح! سيتواصل معك مستشارنا الفني قريباً.');
    }
}
