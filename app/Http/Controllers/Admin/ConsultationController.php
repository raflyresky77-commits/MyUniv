<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with(['student.user', 'teacher.user', 'responses'])
            ->latest()
            ->get();

        return view('admin.consultations.index', compact('consultations'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected,completed'],
        ], [
            'status.required' => 'Status konsultasi wajib dipilih.',
            'status.in' => 'Status konsultasi tidak valid.',
        ]);

        $consultation->update($validated);

        return redirect()->route('admin.consultations.index')->with('success', 'Status konsultasi berhasil diperbarui.');
    }
}
