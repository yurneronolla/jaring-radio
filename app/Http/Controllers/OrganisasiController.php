<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Exports\OrganisasisExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Organisasi::query();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nama_organisasi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_telpon', 'like', "%{$search}%");
            });
        }

        $organisasis = $query->paginate(10)->withQueryString();
        
        return view('organisasi.index', compact('organisasis'));
    }

    public function create()
    {
        return view('organisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'email' => 'required|email',
            'nama_organisasi' => 'required|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('organisasi-photos', 'public');
        }

        Organisasi::create($validated);
        return redirect()->route('organisasi.index')->with('success', 'Data organisasi berhasil ditambahkan!');
    }

    public function edit(Organisasi $organisasi)
    {
        return view('organisasi.edit', compact('organisasi'));
    }

    public function update(Request $request, Organisasi $organisasi)
    {
        $validated = $request->validate([
            'foto' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'email' => 'required|email',
            'nama_organisasi' => 'required|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            if ($organisasi->foto) {
                Storage::disk('public')->delete($organisasi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('organisasi-photos', 'public');
        }

        $organisasi->update($validated);
        return redirect()->route('organisasi.index')->with('success', 'Data organisasi berhasil diupdate!');
    }

    public function destroy(Organisasi $organisasi)
    {
        if ($organisasi->foto) {
            Storage::disk('public')->delete($organisasi->foto);
        }
        $organisasi->delete();
        return redirect()->route('organisasi.index')->with('success', 'Data organisasi berhasil dihapus!');
    }

    /**
     * Export data organisasi ke Excel berdasarkan tahun
     */
    public function export(Request $request)
    {
        $year = $request->input('year');
        $filename = 'data-organisasi';
        
        if ($year) {
            $filename .= '-' . $year;
        }
        
        $filename .= '.xlsx';

        return Excel::download(new OrganisasisExport($year), $filename);
    }
}