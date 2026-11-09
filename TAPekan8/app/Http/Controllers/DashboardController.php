<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Buku\Models\Book;
use Modules\Peminjaman\Models\Peminjaman;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with record counts per module.
     */
    public function __invoke(Request $request): View


    {
        return view('dashboard', [
            'totalBooks' => Book::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'totalUsers' => $request->user()->isAdmin() ?
                User::count() : null,
        ]);
    }
}
