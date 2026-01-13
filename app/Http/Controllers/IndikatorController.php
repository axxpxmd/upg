<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indikator;
use App\Models\Periode;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $periodeFilter = $request->get('periode_id');

        // Auto-select periode based on current year if no filter is set
        if (!$periodeFilter && !$request->has('periode_id')) {
            $currentYearPeriode = Periode::where('tahun', date('Y'))->first();
            if ($currentYearPeriode) {
                $periodeFilter = $currentYearPeriode->id;
            }
        }

        $query = Indikator::with('periode');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_indikator', 'like', "%{$search}%")
                  ->orWhereHas('periode', function($q) use ($search) {
                      $q->where('tahun', 'like', "%{$search}%");
                  });
            });
        }

        if ($periodeFilter) {
            $query->where('periode_id', $periodeFilter);
        }

        $indikators = $query->orderBy('periode_id', 'desc')
                           ->orderBy('nama_indikator', 'asc')
                           ->paginate(10)
                           ->appends(request()->query());

        // Statistics - based on selected filter
        $periodeAktif = Periode::where('is_active', true)->first();
        $selectedPeriode = null;

        if ($periodeFilter) {
            // If periode filter is selected, show stats for that periode
            $selectedPeriode = Periode::find($periodeFilter);
            $totalIndikator = Indikator::where('periode_id', $periodeFilter)->count();
            $indikatorPeriodeAktif = $totalIndikator;
            $totalBobot = Indikator::where('periode_id', $periodeFilter)->sum('bobot_persen');
        } else {
            // If no filter, show all stats
            $totalIndikator = Indikator::count();
            $indikatorPeriodeAktif = $periodeAktif ? Indikator::where('periode_id', $periodeAktif->id)->count() : 0;
            $totalBobot = $periodeAktif ? Indikator::where('periode_id', $periodeAktif->id)->sum('bobot_persen') : 0;
            $selectedPeriode = $periodeAktif;
        }

        // Get all periodes for filter dropdown
        $periodes = Periode::orderBy('tahun', 'desc')->get();

        return view('pages.indikator.index', compact(
            'indikators',
            'totalIndikator',
            'periodeAktif',
            'indikatorPeriodeAktif',
            'totalBobot',
            'periodes',
            'periodeFilter',
            'selectedPeriode'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periodes = Periode::orderBy('tahun', 'desc')->get();
        return view('pages.indikator.create', compact('periodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode,id',
            'nama_indikator' => 'required|string|max:255',
            'bobot_persen' => 'nullable|numeric|min:0|max:100',
        ]);

        Indikator::create([
            'periode_id' => $request->periode_id,
            'nama_indikator' => $request->nama_indikator,
            'bobot_persen' => $request->bobot_persen,
        ]);

        return redirect()->route('indikator.index')
                        ->with('success', 'Indikator berhasil ditambahkan.');
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
        $indikator = Indikator::findOrFail($id);
        $periodes = Periode::orderBy('tahun', 'desc')->get();
        return view('pages.indikator.edit', compact('indikator', 'periodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode,id',
            'nama_indikator' => 'required|string|max:255',
            'bobot_persen' => 'nullable|numeric|min:0|max:100',
        ]);

        $indikator = Indikator::findOrFail($id);
        $indikator->update([
            'periode_id' => $request->periode_id,
            'nama_indikator' => $request->nama_indikator,
            'bobot_persen' => $request->bobot_persen,
        ]);

        return redirect()->route('indikator.index')
                        ->with('success', 'Indikator berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $indikator = Indikator::findOrFail($id);
        $indikator->delete();

        return redirect()->route('indikator.index')
                        ->with('success', 'Indikator berhasil dihapus.');
    }
}
