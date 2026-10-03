<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Major;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        // Pastikan memanggil view universities.index dengan data with('majors')
        $universities = University::with('majors')->latest()->get();
        return view('admin.universities.index', compact('universities'));
    }

    public function storeMajor(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'degree' => 'required|string|max:50',
            'accreditation' => 'required|string|max:50',
        ]);

        $university->majors()->create([
            'name' => $request->name,
            'degree' => $request->degree,
            'accreditation' => $request->accreditation,
        ]);

        return back()->with('success', 'Program studi berhasil ditambahkan!');
    }

    public function destroyMajor($id)
    {
        $major = Major::findOrFail($id);
        $major->delete();

        return back()->with('success', 'Program studi berhasil dihapus.');
    }
}
