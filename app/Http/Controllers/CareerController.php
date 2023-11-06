<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Models\UserRegister;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::all();
        return view('dashboard.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('dashboard.careers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:careers',
        ]);

        Career::create($request->all());

        return redirect()->route('careers-all')->with('success', 'Career created successfully!');
    }

    // public function show(Career $career)
    public function show($id)
    {
        // Fetch users with the given career_id
        $career = Career::find($id);
        $users = UserRegister::where('career_id', $career->id)->paginate(20);
        
        return view('dashboard.careers.show', compact('career', 'users'));
    }

    public function edit(Career $career)
    {
        return view('careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $request->validate([
            'name' => 'required|string|unique:careers,name,' . $career->id,
        ]);

        $career->update($request->all());

        return redirect()->back()->with('success', 'Career updated successfully!');
    }

    public function destroy(Career $career)
    {

        // ย้ายไปที่ Staff [ carreer_id = 3 ]
        $career->userRegisters()->update(['career_id' => 3]);

        $career->delete();

        return redirect()->back()->with('success', 'Career deleted successfully!');
    }
}
