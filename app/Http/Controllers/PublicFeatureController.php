<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class PublicFeatureController extends Controller
{
    // Halaman Cari Faskes (RS & Klinik)
    public function indexFaskes(Request $request)
    {
        // Fitur Pencarian Sederhana
        $search = $request->input('search');

        $hospitals = Hospital::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('public.faskes', compact('hospitals', 'search'));
    }

    // Halaman Panduan P3K
    public function indexP3K()
    {
        // Data statis panduan bisa ditaruh di sini atau langsung di view
        // Untuk kerapihan, kita taruh di view saja
        return view('public.p3k');
    }
}
