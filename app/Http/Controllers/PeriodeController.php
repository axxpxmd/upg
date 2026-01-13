<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Periode::withCount('indikators');

        if ($search) {
            $query->where('tahun', 'like', "%{$search}%");
        }

        $periodes = $query->orderBy('tahun', 'desc')
                         ->paginate(10)
                         ->appends(request()->query());

        // Statistics
        $totalPeriode = Periode::count();
        $periodeAktif = Periode::where('is_active', true)->count();
        $periodeNonAktif = Periode::where('is_active', false)->count();
        $totalIndikator = Periode::withCount('indikators')->get()->sum('indikators_count');

        return view('pages.periode.index', compact(
            'periodes',
            'totalPeriode',
            'periodeAktif',
            'periodeNonAktif',
            'totalIndikator'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100|unique:periode,tahun',
            'tgl_mulai' => 'nullable|date',
            'tgl_selesai' => 'nullable|date|after_or_equal:tgl_mulai',
            'is_active' => 'boolean',
        ]);

        // If this periode is set to active, deactivate all others
        if ($request->is_active) {
            Periode::where('is_active', true)->update(['is_active' => false]);
        }

        Periode::create([
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'is_active' => $request->is_active ?? false,
        ]);

        return redirect()->route('periode.index')
                        ->with('success', 'Periode berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $periode = Periode::findOrFail($id);
        return view('pages.periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $periode = Periode::findOrFail($id);

        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100|unique:periode,tahun,' . $id,
            'tgl_mulai' => 'nullable|date',
            'tgl_selesai' => 'nullable|date|after_or_equal:tgl_mulai',
            'is_active' => 'boolean',
        ]);

        // If this periode is set to active, deactivate all others
        if ($request->is_active) {
            Periode::where('is_active', true)->where('id', '!=', $id)->update(['is_active' => false]);
        }

        $periode->update([
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'is_active' => $request->is_active ?? false,
        ]);

        return redirect()->route('periode.index')
                        ->with('success', 'Periode berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $periode = Periode::findOrFail($id);

        // Check if periode has indikators
        if ($periode->indikators()->count() > 0) {
            return redirect()->route('periode.index')
                           ->with('error', 'Tidak dapat menghapus periode yang memiliki indikator.');
        }

        $periode->delete();

        return redirect()->route('periode.index')
                        ->with('success', 'Periode berhasil dihapus.');
    }
}
