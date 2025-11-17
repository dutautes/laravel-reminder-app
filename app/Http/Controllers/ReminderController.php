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
        $reminders = Reminder::all();
        return view('reminder.index', compact('reminders'));
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
            'repeat' => $request->repeat
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
    public function show(Reminder $reminder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminder $reminder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        //
    }
}
