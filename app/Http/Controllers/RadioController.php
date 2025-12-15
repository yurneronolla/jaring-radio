<?php

namespace App\Http\Controllers;

use App\Models\Radio;
use App\Models\Provinsi;
use App\Exports\RadiosExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RadioController extends Controller
{
    public function index(Request $request)
    {
        $query = Radio::with('provinsi');

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nama_radio', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_telpon', 'like', "%{$search}%")
                  ->orWhereHas('provinsi', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $radios = $query->paginate(10)->withQueryString();
        
        return view('radio.index', compact('radios'));
    }

    public function provinsi($id, Request $request)
    {
        $provinsi = Provinsi::findOrFail($id);
        $query = Radio::where('provinsi_id', $id);

        // Fitur Pencarian untuk halaman provinsi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nama_radio', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_telpon', 'like', "%{$search}%");
            });
        }

        $radios = $query->paginate(10)->withQueryString();
        
        return view('radio.provinsi', compact('radios', 'provinsi'));
    }

    public function create()
    {
        $provinsis = Provinsi::all();
        return view('radio.create', compact('provinsis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provinsi_id' => 'required|exists:provinsis,id',
            'foto' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'email' => 'required|email',
            'nama_radio' => 'required|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('radio-photos', 'public');
        }

        Radio::create($validated);
        return redirect()->route('radio.index')->with('success', 'Data radio berhasil ditambahkan!');
    }

    public function edit(Radio $radio)
    {
        $provinsis = Provinsi::all();
        return view('radio.edit', compact('radio', 'provinsis'));
    }

    public function update(Request $request, Radio $radio)
    {
        $validated = $request->validate([
            'provinsi_id' => 'required|exists:provinsis,id',
            'foto' => 'nullable|image|max:2048',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'email' => 'required|email',
            'nama_radio' => 'required|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            if ($radio->foto) {
                Storage::disk('public')->delete($radio->foto);
            }
            $validated['foto'] = $request->file('foto')->store('radio-photos', 'public');
        }

        $radio->update($validated);
        return redirect()->route('radio.index')->with('success', 'Data radio berhasil diupdate!');
    }

    public function destroy(Radio $radio)
    {
        if ($radio->foto) {
            Storage::disk('public')->delete($radio->foto);
        }
        $radio->delete();
        return redirect()->route('radio.index')->with('success', 'Data radio berhasil dihapus!');
    }

    /**
     * Export data radio ke Excel berdasarkan tahun
     */
    public function export(Request $request)
    {
        $year = $request->input('year');
        $filename = 'data-radio';
        
        if ($year) {
            $filename .= '-' . $year;
        }
        
        $filename .= '.xlsx';

        return Excel::download(new RadiosExport($year), $filename);
    }
}