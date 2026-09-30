<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Client;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\ServiceRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services_count'   => Service::count(),
            'projects_count'   => Project::count(),
            'clients_count'    => Client::count(),
            'posts_count'      => BlogPost::count(),
            'users_count'      => User::count(),
            'unread_messages'  => ContactMessage::where('is_read', false)->count(),
            'pending_requests' => ServiceRequest::where('status', 'جديد')->count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentRequests = ServiceRequest::latest()->take(5)->get();
        $recentPosts    = BlogPost::latest('published_at')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentRequests', 'recentPosts'));
    }
}
