<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\UserRegister;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
        // $contacts = Contact::all();
        $contacts = Contact::orderBy('already_read', 'asc')->orderBy('created_at', 'desc')->get();
        return view('dashboard.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->available_time_contact_formatted = Carbon::parse($contact->available_time_contact)->format('d M Y H:i:s');

        return view('dashboard.contacts.show', compact('contact'));
    }

    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_register_id' => 'required|exists:user_registers,id',
            'hospital' => 'nullable|string',
            'available_time_contact' => 'nullable|string',
            'topic' => 'nullable|string',
            'already_read' => 'boolean',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Contact created successfully');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully');
    }
    
    public function changeAlreadyRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['already_read' => !$contact->already_read]);

        return redirect()->route('contacts-all')->with('success', 'Contact status updated successfully');
        // return response()->json(['update' => 'ok']);
    }

    public function getUserDataToken(Request $request)
    {
        $lineUserId = $request->input('line_token');
        $user = UserRegister::where('line_token', $lineUserId)->get();
        return response()->json(['user' => $user->first()], 200);
    }
}
