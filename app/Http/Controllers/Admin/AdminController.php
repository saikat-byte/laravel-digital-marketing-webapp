<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Dashboard
    public function index(){
        $totalUsers = User::count();
        $totalSubscribers = Subscriber::where('status', 1)->count();
        $totalAppointments = Appointment::count();
        $totalPosts = Post::count();
        return view('admin.modules.dashboard', compact('totalUsers', 'totalSubscribers', 'totalAppointments', 'totalPosts'));
    }
}
