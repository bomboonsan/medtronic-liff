<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRegister;
use App\Models\Contact;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $userRegisters = UserRegister::all();
        $userPending = UserRegister::where('status', 'pending')->get();
        $userApproved = UserRegister::where('status', 'approved')->get();
        $userDisapproved = UserRegister::where('status', 'disapproved')->get();

        $usersMonth = UserRegister::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
        ->groupBy('year', 'month')
        // ->orderBy('year', 'desc')
        // ->orderBy('month', 'desc')
        ->orderBy('month', 'asc')
        ->paginate(20);

        $userSpecialties = UserRegister::select('specialty_id', 'specialties.name as specialty_name', DB::raw('COUNT(*) as count'))
        ->join('specialties', 'user_registers.specialty_id', '=', 'specialties.id')
        ->groupBy('specialty_id', 'specialties.name')
        ->orderBy('count', 'desc')
        ->get();

        $userCareers = UserRegister::select('career_id', 'careers.name as career_name', DB::raw('COUNT(*) as count'))
        ->join('careers', 'user_registers.career_id', '=', 'careers.id')
        ->groupBy('career_id', 'careers.name')
        ->orderBy('count', 'desc')
        ->get();

        $contactsRead = Contact::where('already_read', '1')->get();
        $contactsNoRead = Contact::where('already_read', '0')->get();


        return view('dashboard', compact(
            'userRegisters',
            'userPending',
            'userApproved',
            'userDisapproved',
            'usersMonth',
            'userSpecialties',
            'userCareers',
            'contactsRead',
            'contactsNoRead'
        ));
    }
}
