<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Ambil notifikasi mahasiswa yang sedang login berdasarkan NRP
        $nrp = Auth::user()->mahasiswa->nrp;
        $notifications = Notification::where('nrp', $nrp)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead()
    {
        if (Auth::check()) {
            Notification::where('nrp', Auth::user()->nrp)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }
}
