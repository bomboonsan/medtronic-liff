<?php

namespace App\Http\Controllers;


use App\Models\UserRegister;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Specialty; 

class UserRegisterController extends Controller
{    
    public function index()
    {
        $userRegisters = UserRegister::all();
        return view('dashboard.users.index', compact('userRegisters'));
    }

    public function checkLineToken($lineToken)
    {
        // Check if the user is already registered
        $userRegister = UserRegister::where('line_token', $lineToken)->first();
        // dd($userRegister);
        return view('checkToken', compact('userRegister'));
    }

    public function pending()
    {
        $userRegisters = UserRegister::where('status', 'pending')->get();
        return view('dashboard.users.pending', compact('userRegisters'));
    }

    public function approval()
    {
        $userRegisters = UserRegister::where('status', 'approved')->get();
        return view('dashboard.users.approval', compact('userRegisters'));
    }

    public function disapproval()
    {
        $userRegisters = UserRegister::where('status', 'disapproved')->get();
        return view('dashboard.users.disapproval', compact('userRegisters'));
    }

    

    public function create()
    {
        // You can pass the list of careers and specialties to the view
        // to populate dropdowns in the registration form
        $careers = Career::all();
        $specialties = Specialty::all();

        return view('register', compact('careers', 'specialties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'line_token' => 'required|string',
            'line_img' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'career_id' => 'required|exists:careers,id',
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required|string',
            'email' => 'required|email|unique:user_registers,email',
            // 'telephone' => 'required|string|unique:user_registers,telephone',
            // 'telephone' => 'string|unique:user_registers,telephone',
            'consented' => 'required|boolean',
            // 'agent' => 'required|string',
            // 'event' => 'required|string',
            // 'status' => 'required|string',
        ]);
    
        // Check if the fields are present in the request, if not, set default values
        $request->merge([
            'telephone' => $request->input('telephone', 'NULL'),
            'agent' => $request->input('agent', 'NULL'),
            'event' => $request->input('event', 'NULL'),
            'status' => $request->input('status', 'pending'),
        ]);

        UserRegister::create($request->all());

        return redirect()->route('user_registers.index')->with('success', 'User registered successfully!');
    }

    public function show(UserRegister $userRegister)
    {
        return view('user_registers.show', compact('userRegister'));
    }

    public function edit(UserRegister $userRegister)
    {
        $careers = Career::all();
        $specialties = Specialty::all();

        return view('user_registers.edit', compact('userRegister', 'careers', 'specialties'));
    }

    public function update(Request $request, UserRegister $userRegister)
    {
        $request->validate([
            'line_token' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'career_id' => 'required|exists:careers,id',
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required|string',
            'email' => 'required|email|unique:users_registers,email,' . $userRegister->id,
            'telephone' => 'required|string|unique:users_registers,telephone,' . $userRegister->id,
            'consented' => 'required|boolean',
            'agent' => 'required|string',
            'event' => 'required|string',
            'status' => 'required|string',
        ]);

        // Check if the fields are present in the request, if not, set default values
        $request->merge([
            'agent' => $request->input('agent', 'NULL'),
            'event' => $request->input('event', 'NULL'),
            'status' => $request->input('status', 'NULL'),
        ]);

        $userRegister->update($request->all());

        return redirect()->route('user_registers.index')->with('success', 'User details updated successfully!');
    }

    public function destroy(UserRegister $userRegister)
    {
        $userRegister->delete();

        return redirect()->route('user_registers.index')->with('success', 'User removed successfully!');
    }


    public function handlePending($id)
    {
        $userRegister = UserRegister::find($id);
        $userRegister->status = 'pending';
        $userRegister->save();
        return redirect()->route('user_registers.index')->with('success', 'User Pending successfully!');
    }
    public function handleApproval($id)
    {
        $userRegister = UserRegister::find($id);
        $userRegister->status = 'approved';
        $userRegister->save();
        return redirect()->route('user_registers.index')->with('success', 'User Approved successfully!');
    }
    public function handleDisapproval($id)
    {
        $userRegister = UserRegister::find($id);
        $userRegister->status = 'disapproved';
        $userRegister->save();
        return redirect()->route('user_registers.index')->with('success', 'User Disapproved successfully!');
    }
}
