<?php

namespace App\Http\Controllers;


use App\Models\UserRegister;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Specialty; 

use Illuminate\Support\Facades\Http;

class UserRegisterController extends Controller
{    
    public function index()
    {
        // $userRegisters = UserRegister::all();
        $userRegisters = UserRegister::orderBy('created_at', 'desc')->paginate(20);
        return view('dashboard.users.index', compact('userRegisters'));
    }

    public function checkLineToken($lineToken)
    {
        // Check if the user is already registered
        $userRegister = UserRegister::where('line_token', $lineToken)->first();
        // dd($userRegister);
        return view('checkToken', compact('userRegister'));
    }

    public function checkRegistration(Request $request)
    {
        $lineUserId = $request->input('line_token');
        $existingUser = UserRegister::where('line_token', $lineUserId)->first();
        
        return response()->json(['registered' => $existingUser !== null]);
    }

    public function pending()
    {
        // $userRegisters = UserRegister::where('status', 'pending')->get();
        $userRegisters = UserRegister::where('status', 'pending')->orderBy('created_at', 'desc')->paginate(20);
        return view('dashboard.users.pending', compact('userRegisters'));
    }

    public function approval()
    {
        $userRegisters = UserRegister::where('status', 'approved')->orderBy('created_at', 'desc')->paginate(20);
        return view('dashboard.users.approval', compact('userRegisters'));
    }

    public function disapproval()
    {
        $userRegisters = UserRegister::where('status', 'disapproved')->orderBy('created_at', 'desc')->paginate(20);
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

        // $line_token_user_ID = $request->input('line_token');

        // UserRegister::create($request->all());
        $user = UserRegister::create($request->all());

        // return redirect()->route('user_registers.index')->with('success', 'User registered successfully!');

        // เปลี่ยน Rich Menu ID สำหรับผู้ใช้ที่ลงทะเบียน
        $pendingRishmenu = env('RISHMENU_ID_PENDING');
        $this->setRichMenuForUser($user->line_token, $pendingRishmenu);

        // return redirect()->route('user-checkLineToken', $user->line_token)->with('success', 'User registered successfully!');
        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function show($id)
    {
        $userRegister = UserRegister::find($id);
        return view('dashboard.users.show', compact('userRegister'));
    }

    public function edit($id)
    {
        $careers = Career::all();
        $specialties = Specialty::all();

        $userRegister = UserRegister::find($id);

        return view('dashboard.users.edit', compact('userRegister', 'careers', 'specialties'));
    }

    // public function update(Request $request, UserRegister $userRegister)
    public function update(Request $request, UserRegister $userRegister)
    {
        if ($request->filled('telephone')) {
            $userRegister->telephone = $request->input('telephone');
        }

        $validatedData = $request->validate([
            // 'line_token' => 'required|string',
            // 'line_img' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'career_id' => 'required|exists:careers,id',
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required|string',
            'email' => 'required|email|unique:user_registers,email,' . $userRegister->id,
            'telephone' => 'required|string|unique:user_registers,telephone,' . $userRegister->id,


            // 'consented' => 'required|boolean',
            // 'agent' => 'nullable|string',
            // 'event' => 'nullable|string',
            // 'status' => 'nullable|string',
        ]);
        

        $userRegister->update($validatedData);
        // $userRegister->update($request->all());
        

        // return redirect()->route('user-show', $userRegister->id)->with('success', 'User details updated successfully!');
        return redirect()->back()->with('success', 'User details updated successfully!');
    }

    public function destroy(UserRegister $userRegister)
    {
        $userRegister->delete();
        // ลบ Rich Menu
        $this->removeRichMenuForUser($userRegister->line_token);

        return redirect()->route('user_registers.index')->with('success', 'User removed successfully!');
    }


    public function handlePending($id)
    {
        $userRegister = UserRegister::find($id);
        $userRegister->status = 'pending';
        $userRegister->save();
        // เปลี่ยน Rich Menu ID
        $pendingRishmenu = env('RISHMENU_ID_PENDING');
        $this->setRichMenuForUser($userRegister->line_token, $pendingRishmenu);

        return redirect()->route('user_registers.index')->with('success', 'User Pending successfully!');
    }
    public function handleApproval($id)
    {
        $userRegister = UserRegister::find($id);
        $userRegister->status = 'approved';
        $userRegister->save();
        // เปลี่ยน Rich Menu ID
        $approvalRishmenu = env('RISHMENU_ID_APPROVAL');
        $this->setRichMenuForUser($userRegister->line_token, $approvalRishmenu);

        return redirect()->route('user_registers.index')->with('success', 'User Approved successfully!');
    }
    public function handleDisapproval($id)
    {
        $userRegister = UserRegister::find($id);
        $userRegister->status = 'disapproved';
        $userRegister->save();
        // เปลี่ยน Rich Menu ID
        $suspendedRishmenu = env('RISHMENU_ID_SUSPENDED');
        $this->setRichMenuForUser($userRegister->line_token, $suspendedRishmenu);

        return redirect()->route('user_registers.index')->with('success', 'User Disapproved successfully!');
    }

    // ฟังก์ชันสำหรับเปลี่ยน Rich Menu ID สำหรับผู้ใช้
    private function setRichMenuForUser($lineToken, $richMenuId)
    {
        $url = "https://api.line.me/v2/bot/user/{$lineToken}/richmenu/{$richMenuId}";
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN'), // ใช้ Channel Access Token จาก .env
        ])->post($url);

        // ตรวจสอบว่าการเปลี่ยน Rich Menu สำเร็จหรือไม่
        if ($response->successful()) {
            // ดำเนินการเมื่อสำเร็จ
            return redirect()->route('user_registers.index')->with('success', 'User registered successfully!');
        } else {
            // ดำเนินการเมื่อไม่สำเร็จ            
            return redirect()->route('user_registers.index')->with('error', 'Failed to set Rich Menu for the user.');
        }
    }

    // ฟังก์ชันสำหรับลบ Rich Menu ID สำหรับผู้ใช้
    private function removeRichMenuForUser($lineToken)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN'),
        ])->delete("https://api.line.me/v2/bot/user/{$lineToken}/richmenu");

        // ตรวจสอบสถานะการเรียก API
        if ($response->successful()) {
            // ลบ Rich Menu สำเร็จ
            return redirect()->route('user_registers.index')->with('success', 'Rich Menu removed for the user.');
        } else {
            // ไม่สามารถลบ Rich Menu ได้
            return redirect()->route('user_registers.index')->with('error', 'Failed to remove Rich Menu for the user.');
        }
    }

}
