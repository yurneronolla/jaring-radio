<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Radio;
use App\Models\Organisasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRadio = Radio::count();
        $totalOrganisasi = Organisasi::count();
        $totalProvinsi = Provinsi::count();
        
        $provinsis = Provinsi::withCount('radios')->get();
        
        return view('dashboard', compact('totalRadio', 'totalOrganisasi', 'totalProvinsi', 'provinsis'));
    }
}