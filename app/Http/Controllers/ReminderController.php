<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\UserActivity; // model ua
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // export pdf
use Carbon\Carbon;

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

        // log activity
        $log = new UserActivity();
        $log->saveActivity(
            'create_reminder',
            'Membuat reminder baru',
            'Reminder',
            $createData->id
        );

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

        // log activity
        // $log = new UserActivity();
        // $log->saveActivity(
        //     'update_reminder',
        //     'Mengubah reminder',
        //     'Reminder',
        //     $updateData->id
        // );

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

        // log activity
        $log = new UserActivity();
        $log->saveActivity(
            'delete_reminder',
            'Menghapus reminder',
            'Reminder',
            $reminder->id
        );

        return redirect()->route('reminder.index')->with('success', 'Reminder deleted.');
    }

    // toggle reminder
    public function toggle($id)
    {
        $reminder = Reminder::findOrFail($id);

        // simpan status lama (biar tau berubah ke apa)
        $oldStatus = $reminder->status;

        // toggle status
        $reminder->status = !$reminder->status;
        $reminder->save();

        // tentuin aksi nya
        $action = $reminder->status
            ? 'complete_reminder'
            : 'uncomplete_reminder';

        // deskripsi
        $description = $reminder->status
            ? 'Menandai reminder sebagai selesai'
            : 'Membatalkan status selesai reminder';

        // log activity
        $log = new UserActivity();
        $log->saveActivity(
            $action,
            $description,
            'Reminder',
            $reminder->id
        );

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
        $user = Auth::user();

        // ambil semua reminder punya user
        $reminders = $user->reminders()->orderBy('created_at', 'desc')->get();

        // hitung2
        $total = $reminders->count();
        $done = $reminders->where('status', 1)->count();
        $pending = $reminders->where('status', 0)->count();

        $percentage = $total > 0 ? round(($done / $total) * 100, 1) : 0;

        // ambil 5 terbaru
        $latest = $reminders->take(5);

        $pdf = Pdf::loadView('pdf.dashboard-report', [
            'user' => $user,
            'total' => $total,
            'done' => $done,
            'pending' => $pending,
            'percentage' => $percentage,
            'latest' => $latest,
            'date' => Carbon::now(),
        ]);

        $pemilik = $user->name;

        return $pdf->download('dashboard-report' . $pemilik . '.pdf');
    }
}
