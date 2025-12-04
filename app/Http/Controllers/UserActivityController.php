<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function index()
    {
        $activities = UserActivity::with('user')->latest()->get();
        return view('admin.activity.index', compact('activities'));
    }
}
