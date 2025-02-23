<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Dashboard
    public function index(){
        $users = User::all();
        return view('admin.modules.dashboard', compact('users'));
    }
}
