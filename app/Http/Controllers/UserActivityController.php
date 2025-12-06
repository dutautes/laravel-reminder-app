<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables; // class laravel yajra : datatables


class UserActivityController extends Controller
{
    // index ke halaman activity nya
    public function index()
    {
        $activities = UserActivity::with('user')->latest()->get(); // latest() : urutin dari yang terbaru berdasarkan created_at nya
        return view('admin.activity.index', compact('activities'));
    }

    // datatables buat user activity
    public function datatablesActivity()
    {
        $activities = UserActivity::with('user')->latest();
        return DataTables::of($activities)
            ->addIndexColumn()
            ->addColumn('user_name', function ($activity) {
                return $activity->user->name;
            })
            ->addColumn('refrence', function ($activity) {
                return $activity->ref_type . ' ID:' . '<b>' . $activity->ref_id . '</b>';
            })
            ->addColumn('created_at', function ($activity) {
                return $activity->created_at->format('d M Y H:i');
            })
            ->rawColumns(['user_name', 'refrence', 'created_at'])
            ->make(true);
    }
}
