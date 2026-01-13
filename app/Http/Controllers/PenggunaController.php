<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::with('opd');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('jabatan', 'like', '%' . $search . '%')
                  ->orWhere('no_hp', 'like', '%' . $search . '%');
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->get();

        // Calculate statistics
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $operatorCount = User::where('role', 'operator')->count();
        $verifikatorCount = User::where('role', 'verifikator')->count();

        return view('pages.pengguna.index', compact('users', 'totalUsers', 'adminCount', 'operatorCount', 'verifikatorCount'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $opds = Opd::all();
        return view('pages.pengguna.create', compact('opds'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:12',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/'
            ],
            'nik' => 'nullable|numeric|digits:16',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users',
            'no_hp' => 'nullable|string|max:255',
            'role' => 'required|in:admin,operator,verifikator',
            'opd_id' => 'required|exists:opd,id',
        ], [
            'password.regex' => 'Password harus mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu karakter spesial (@$!%*?&#).'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\View\View
     */
    public function show(User $pengguna)
    {
        return view('pages.pengguna.show', compact('pengguna'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\View\View
     */
    public function edit(User $pengguna)
    {
        $opds = Opd::all();
        return view('pages.pengguna.edit', compact('pengguna', 'opds'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $pengguna)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $pengguna->id,
            'password' => [
                'nullable',
                'string',
                'min:12',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/'
            ],
            'nik' => 'nullable|numeric|digits:16',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $pengguna->id,
            'no_hp' => 'nullable|string|max:255',
            'role' => 'required|in:admin,operator,verifikator',
            'opd_id' => 'required|exists:opd,id',
        ], [
            'password.regex' => 'Password harus mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu karakter spesial (@$!%*?&#).'
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $pengguna->update($validated);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diupdate!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
