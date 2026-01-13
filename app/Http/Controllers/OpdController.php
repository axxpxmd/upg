<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    /**
     * Display a listing of OPD.
     */
    public function index(Request $request)
    {
        $query = Opd::withCount('users');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('n_opd', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        }

$opds = $query->latest()->paginate(10);

        // Calculate statistics
        $totalOpd = Opd::count();
        $opdWithUsers = Opd::has('users')->count();
        $opdWithoutUsers = Opd::doesntHave('users')->count();
        $totalUsers = Opd::withCount('users')->get()->sum('users_count');

        return view('pages.opd.index', compact('opds', 'totalOpd', 'opdWithUsers', 'opdWithoutUsers', 'totalUsers'));
    }

    /**
     * Show the form for creating a new OPD.
     */
    public function create()
    {
        return view('pages.opd.create');
    }

    /**
     * Store a newly created OPD in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'n_opd' => 'required|string|max:255|unique:opd',
            'alamat' => 'nullable|string|max:500',
        ]);

        Opd::create($validated);

        return redirect()->route('opd.index')->with('success', 'OPD berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified OPD.
     */
    public function edit(Opd $opd)
    {
        return view('pages.opd.edit', compact('opd'));
    }

    /**
     * Update the specified OPD in storage.
     */
    public function update(Request $request, Opd $opd)
    {
        $validated = $request->validate([
            'n_opd' => 'required|string|max:255|unique:opd,n_opd,' . $opd->id,
            'alamat' => 'nullable|string|max:500',
        ]);

        $opd->update($validated);

        return redirect()->route('opd.index')->with('success', 'OPD berhasil diupdate!');
    }

    /**
     * Remove the specified OPD from storage.
     */
    public function destroy(Opd $opd)
    {
        // Check if OPD has users
        if ($opd->users()->count() > 0) {
            return redirect()->route('opd.index')->with('error', 'OPD tidak dapat dihapus karena masih memiliki pengguna terdaftar!');
        }

        $opd->delete();

        return redirect()->route('opd.index')->with('success', 'OPD berhasil dihapus!');
    }
}
