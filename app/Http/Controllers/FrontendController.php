<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Time;
use App\Models\User;
use App\Mail\AppointmentMail;
use App\Models\Prescription;



class FrontendController extends Controller
{
    //


    public function index( Request $request){
        date_default_timezone_set('Asia/Dhaka');
        // If there is set date, find the doctors
        if (request('date')) {
            $doctors = $this->findDoctorsBasedOnDate(request('date'));
            // dd($this->findDoctorsBasedOnDate(request('date')));
            return view('welcome', compact('doctors'));
        }
        
        // $date = date('d-m-y ');
        // echo $date;
        //  return $time;
        // return date("d-M-y h:i") ;
        // dd(date('Y-m-d '));
        // dd(date("h:i:sa"));
        // $timestamp = date("Y-m-d H:i:s");
        // $timestamp = date("Y-m-d");
        // return $timestamp;
        // 3echo "The time is " . date("Y-m-d ");

//      

// $x = new Date("m-d-yy");
//        return x;
         $doctors = Appointment::where('date', date('m-d-Y'))->get();
        //  return $doctors;
        return view('welcome', compact('doctors'));
        // return view('welcome');

       
    }
    
    public function show($doctorId, $date)
    {
        
        $appointment = Appointment::where('user_id', $doctorId)->where('date', $date)->first();
        $times = Time::where('appointment_id', $appointment->id)->where('status', 0)->get();
        $user = User::where('id', $doctorId)->first();
        $doctor_id = $doctorId;
        if(is_null(auth()->user()->phone_number)) {
            return redirect()->route('phone')->with('message','Your phone number must have to be validated!');
        }
        // return $times;
        return view('appointment', compact('times','date','user','doctor_id'));
       
    }
    public function findDoctorsBasedOnDate($date){
        $doctors = Appointment::where('date', $date)->get();
        return $doctors;
    }
    public function store(Request $request)
    {
        // Set timezone
        date_default_timezone_set('Asia/Dhaka');

        $request->validate(['time' => 'required']);
        $check = $this->checkBookingTimeInterval();
        if ($check) {
            return redirect()->back()->with('errMessage', 'You already made an appointment. Please wait to make new appointment');
        }
        $doctorId = $request->doctorId;
        $time = $request->time;
        $appointmentId = $request->appointmentId;
        $date = $request->date;
        Booking::create([
            'user_id' => auth()->user()->id,
            'doctor_id' => $doctorId,
            'time' => $time,
            'date' => $date,
            'status' => 0
        ]);
        $doctor = User::where('id', $doctorId)->first();
        Time::where('appointment_id', $appointmentId)->where('time', $time)->update(['status' => 1]);
         // Send email notification
         $mailData = [
            'name' => auth()->user()->name,
            'time' => $time,
            'date' => $date,
            'doctorName' => $doctor->name
        ];
        try {
            \Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));
        } catch (\Exception $e) {
        }

        return redirect()->back()->with('message', 'Your appointment was booked for ' . $date . ' at ' . $time . ' with ' . $doctor->name . '.');
    }
    // check if user already make a booking.
    public function checkBookingTimeInterval()
    {
        return Booking::orderby('id', 'desc')
            ->where('user_id', auth()->user()->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->exists();
    }
    public function myBookings()
    {
        $appointments = Booking::latest()->where('user_id', auth()->user()->id)->get();
        return view('booking.index', compact('appointments'));
    }

    public function myPrescription()
    {
        $prescriptions = Prescription::where('user_id', auth()->user()->id)->get();
        return view('my-prescription', compact('prescriptions'));
    }



    public function doctorToday(Request $request)
    {
        $doctors= Appointment::with('doctor')->whereDate('date',date('Y-m-d'))->get();
        return $doctors;
    }

    public function findDoctors(Request $request)
    {
        $doctors= Appointment::with('doctor')->whereDate('date',$request->date)->get();
        return $doctors;
    }

}
