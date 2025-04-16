<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->mahasiswa) {
        $role = 'mahasiswa';
        $nrp = $user->mahasiswa->nrp;
    } elseif ($user->kaprodi) {
        $role = 'kaprodi';
        $nrp = $user->kaprodi->nrp;
    } elseif ($user->tatausaha) {
        $role = 'tu';
        $nrp = $user->tatausaha->nrp;
    } else {
        return redirect()->back()->with('error', 'Role tidak dikenali.');
    }

    $notifications = Notification::where('role', $role)
        ->where('nrp', $nrp)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('notifications.index', compact('notifications'));
}



public function markAsRead()
{
    $user = Auth::user();

    if ($user->mahasiswa) {
        $role = 'mahasiswa';
        $nrp = $user->mahasiswa->nrp;
    } elseif ($user->kaprodi) {
        $role = 'kaprodi';
        $nrp = $user->kaprodi->nrp;
    } elseif ($user->tatausaha) {
        $role = 'tu';
        $nrp = $user->tatausaha->nrp;
    } else {
        return response()->json(['success' => false]);
    }

    Notification::where('role', $role)
        ->where('nrp', $nrp)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

}
