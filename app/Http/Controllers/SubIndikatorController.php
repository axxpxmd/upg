<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubIndikator;
use App\Models\Indikator;
use App\Models\Periode;

class SubIndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $indikatorFilter = $request->get('indikator_id');

        $query = SubIndikator::with('indikator.periode');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_sub_indikator', 'like', "%{$search}%")
                  ->orWhereHas('indikator', function($q) use ($search) {
                      $q->where('nama_indikator', 'like', "%{$search}%");
                  });
            });
        }

        if ($indikatorFilter) {
            $query->where('indikator_id', $indikatorFilter);
        }

        $subIndikators = $query->orderBy('indikator_id', 'desc')
                              ->orderBy('nama_sub_indikator', 'asc')
                              ->paginate(10)
                              ->appends(request()->query());

        // Statistics
        $totalSubIndikator = SubIndikator::count();
        $totalBobot = SubIndikator::sum('bobot_sub_persen');
        $indikatorWithSub = SubIndikator::distinct('indikator_id')->count('indikator_id');

        // Get indikators for filter dropdown
        $indikators = Indikator::with('periode')
                               ->orderBy('periode_id', 'desc')
                               ->orderBy('nama_indikator', 'asc')
                               ->get();

        return view('pages.sub-indikator.index', compact(
            'subIndikators',
            'totalSubIndikator',
            'totalBobot',
            'indikatorWithSub',
            'indikators',
            'indikatorFilter'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $indikators = Indikator::with('periode')
                               ->orderBy('periode_id', 'desc')
                               ->orderBy('nama_indikator', 'asc')
                               ->get();
        $periodes = Periode::orderBy('tahun', 'desc')->get();
        return view('pages.sub-indikator.create', compact('indikators', 'periodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'indikator_id' => 'required|exists:indikator,id',
            'nama_sub_indikator' => 'required|array|min:1',
            'nama_sub_indikator.*' => 'required|string|max:255',
            'bobot_sub_persen' => 'nullable|array',
            'bobot_sub_persen.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $namaSubIndikators = $request->nama_sub_indikator;
        $bobotSubPersens = $request->bobot_sub_persen ?? [];

        foreach ($namaSubIndikators as $index => $namaSubIndikator) {
            SubIndikator::create([
                'indikator_id' => $request->indikator_id,
                'nama_sub_indikator' => $namaSubIndikator,
                'bobot_sub_persen' => $bobotSubPersens[$index] ?? null,
            ]);
        }

        return redirect()->route('sub-indikator.index')
                        ->with('success', count($namaSubIndikators) . ' Sub Indikator berhasil ditambahkan.');
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
        $subIndikator = SubIndikator::findOrFail($id);
        $indikators = Indikator::with('periode')
                               ->orderBy('periode_id', 'desc')
                               ->orderBy('nama_indikator', 'asc')
                               ->get();
        $periodes = Periode::orderBy('tahun', 'desc')->get();
        return view('pages.sub-indikator.edit', compact('subIndikator', 'indikators', 'periodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'indikator_id' => 'required|exists:indikator,id',
            'nama_sub_indikator' => 'required|string|max:255',
            'bobot_sub_persen' => 'nullable|numeric|min:0|max:100',
        ]);

        $subIndikator = SubIndikator::findOrFail($id);
        $subIndikator->update([
            'indikator_id' => $request->indikator_id,
            'nama_sub_indikator' => $request->nama_sub_indikator,
            'bobot_sub_persen' => $request->bobot_sub_persen,
        ]);

        return redirect()->route('sub-indikator.index')
                        ->with('success', 'Sub Indikator berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subIndikator = SubIndikator::findOrFail($id);
        $subIndikator->delete();

        return redirect()->route('sub-indikator.index')
                        ->with('success', 'Sub Indikator berhasil dihapus.');
    }
}
