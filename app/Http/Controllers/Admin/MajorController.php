<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\University;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::latest()->get();
        return view('admin.majors.index', compact('majors'));
    }

    public function create()
    {
        $universities = University::all();
        return view('admin.majors.create', compact('universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
        ]);

        Major::create($request->all());

        return redirect()->route('admin.majors.index')->with('success', 'Program studi baru berhasil ditambahkan!');
    }

    public function edit(Major $major)
    {
        $universities = University::all();
        return view('admin.majors.edit', compact('major', 'universities'));
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
        ]);

        $major->update($request->all());

        return redirect()->route('admin.majors.index')->with('success', 'Program studi berhasil diperbarui!');
    }

    public function destroy(Major $major)
    {
        $major->delete();

        return back()->with('success', 'Program studi berhasil dihapus.');
    }
}
