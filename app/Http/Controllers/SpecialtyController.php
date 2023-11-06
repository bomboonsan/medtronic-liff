<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Models\UserRegister;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('dashboard.specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('dashboard.specialties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:specialties',
        ]);

        Specialty::create($request->all());

        return redirect()->route('specialties-all')->with('success', 'Specialty created successfully!');
    }

    // public function show(Specialty $specialty)
    public function show($id)
    {
        $specialty = Specialty::find($id);
        $users = UserRegister::where('specialty_id', $specialty->id)->paginate(20);

        return view('dashboard.specialties.show', compact('specialty', 'users'));
    }

    // public function edit(Specialty $specialty)
    public function edit($id)
    {
        $specialty = Specialty::find($id);
        return view('dashboard.specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|string|unique:specialties,name,' . $specialty->id,
        ]);

        $specialty->update($request->all());

        return redirect()->route('specialties.index')->with('success', 'Specialty updated successfully!');
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return redirect()->route('specialties.index')->with('success', 'Specialty deleted successfully!');
    }
}
