<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active = Reminder::where('user_id', Auth::id())->where('status', 0)->get();
        $completed = Reminder::where('user_id', Auth::id())->where('status', 1)->get();
        return view('reminder.index', compact('active', 'completed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'due_at' => 'required',
            'repeat' => 'required'
        ], [
            'title.required' => 'Judul wajib diisi!',
            'title.min' => 'Judul minimal 3 huruf!',
            'description.required' => 'Deskripsi wajib diisi!',
            'due_at' => 'Tanggal dan Waktu wajib diisi!',
            'repeat' => 'Repeat wajib dipilih'
        ]);

        $createData = Reminder::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_at' => $request->due_at,
            'repeat' => $request->repeat,
            'status' => 0,
        ]);

        if ($createData) {
            return redirect()->route('reminder.index')->with('success', 'Data pengguna berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data pengguna');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reminder = Reminder::find($id);
        return view('reminder.detail', compact('reminder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reminder = Reminder::find($id);
        return view('reminder.edit', compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'due_at' => 'required',
            'repeat' => 'required'
        ], [
            'title.required' => 'Judul wajib diisi!',
            'title.min' => 'Judul minimal 3 huruf!',
            'description.required' => 'Deskripsi wajib diisi!',
            'due_at' => 'Tanggal dan Waktu wajib diisi!',
            'repeat' => 'Repeat wajib dipilih'
        ]);

        $updateData = Reminder::where('id', $id)->update([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_at' => $request->due_at,
            'repeat' => $request->repeat
        ]);

        if ($updateData) {
            return redirect()->route('reminder.index')->with('success', 'Data pengguna berhasil di edit');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data pengguna');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->delete();

        return redirect()->route('reminder.index')->with('success', 'Reminder deleted.');
    }

    // toggle reminder
    public function toggle($id)
    {
        $reminder = Reminder::findOrFail($id);

        // toggle
        $reminder->status = !$reminder->status;
        $reminder->save();

        return back();
    }

    // dashboard
    public function dashboardPage()
    {
        $activeCount = Reminder::where('user_id', Auth::id())->where('status', 0)->count();
        $completedCount = Reminder::where('user_id', Auth::id())->where('status', 1)->count();
        return view('dashboard', compact('activeCount', 'completedCount'));
    }

    public function exportDashboardPdf()
    {
        //
    }
}
