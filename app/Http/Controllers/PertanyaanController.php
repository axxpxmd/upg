<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\SubIndikator;
use App\Models\Indikator;
use App\Models\Periode;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $subIndikatorFilter = $request->get('sub_indikator_id');

        $query = Pertanyaan::with('subIndikator.indikator.periode');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('n_pertanyaan', 'like', "%{$search}%")
                  ->orWhereHas('subIndikator', function($q) use ($search) {
                      $q->where('nama_sub_indikator', 'like', "%{$search}%");
                  });
            });
        }

        if ($subIndikatorFilter) {
            $query->where('sub_indikator_id', $subIndikatorFilter);
        }

        $pertanyaans = $query->orderBy('sub_indikator_id', 'desc')
                             ->orderBy('created_at', 'desc')
                             ->paginate(10)
                             ->appends(request()->query());

        // Statistics
        $totalPertanyaan = Pertanyaan::count();
        $subIndikatorWithPertanyaan = Pertanyaan::distinct('sub_indikator_id')->count('sub_indikator_id');

        // Get sub indikators for filter dropdown
        $subIndikators = SubIndikator::with('indikator.periode')
                                     ->orderBy('indikator_id', 'desc')
                                     ->get();

        return view('pages.pertanyaan.index', compact(
            'pertanyaans',
            'totalPertanyaan',
            'subIndikatorWithPertanyaan',
            'subIndikators',
            'subIndikatorFilter'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subIndikators = SubIndikator::with('indikator.periode')
                                     ->orderBy('indikator_id', 'desc')
                                     ->get();
        $indikators = Indikator::with('periode')
                               ->orderBy('periode_id', 'desc')
                               ->get();
        $periodes = Periode::orderBy('tahun', 'desc')->get();
        return view('pages.pertanyaan.create', compact('subIndikators', 'indikators', 'periodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sub_indikator_id' => 'required|exists:sub_indikator,id',
            'n_pertanyaan' => 'required|array|min:1',
            'n_pertanyaan.*' => 'required|string',
        ]);

        $pertanyaans = $request->n_pertanyaan;

        foreach ($pertanyaans as $pertanyaan) {
            Pertanyaan::create([
                'sub_indikator_id' => $request->sub_indikator_id,
                'n_pertanyaan' => $pertanyaan,
            ]);
        }

        return redirect()->route('pertanyaan.index')
                        ->with('success', count($pertanyaans) . ' Pertanyaan berhasil ditambahkan.');
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
        $pertanyaan = Pertanyaan::findOrFail($id);
        $subIndikators = SubIndikator::with('indikator.periode')
                                     ->orderBy('indikator_id', 'desc')
                                     ->get();
        $indikators = Indikator::with('periode')
                               ->orderBy('periode_id', 'desc')
                               ->get();
        $periodes = Periode::orderBy('tahun', 'desc')->get();
        return view('pages.pertanyaan.edit', compact('pertanyaan', 'subIndikators', 'indikators', 'periodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sub_indikator_id' => 'required|exists:sub_indikator,id',
            'n_pertanyaan' => 'required|string',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);
        $pertanyaan->update([
            'sub_indikator_id' => $request->sub_indikator_id,
            'n_pertanyaan' => $request->n_pertanyaan,
        ]);

        return redirect()->route('pertanyaan.index')
                        ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $pertanyaan->delete();

        return redirect()->route('pertanyaan.index')
                        ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
