<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Australia/Melbourne');
        // Get the DOCTOR PATIENTS appointment on the date and checked-in 
        $bookings = Booking::where('date', date('m-d-Y'))->where('status', 1)->where('doctor_id',auth()-> user()->id)->get();
        return view('prescription.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['medicine'] = implode(',',$request->medicine);
        Prescription::create($data);
        return redirect()->back()->with('message', 'A prescription was created successfully!');
    }

    public function show($userId, $date)
    {
        $prescription = Prescription::where('user_id', $userId)->where('date', $date)->first();
        return view('prescription.show', compact('prescription'));
    }

    //get all patients from prescription table
    public function patientsFromPrescription()
    {
        $patients = Prescription::get();
        return view('prescription.all', compact('patients'));
    }


}
