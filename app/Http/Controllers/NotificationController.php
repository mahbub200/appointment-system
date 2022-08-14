<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class NotificationController extends Controller
{
    public function phoneValidation () {
        return view('auth.phone_validation');
    }
    public function phoneUpdate (Request $request) {
        if($request->valid_code !== $request->code) {
            User::where('id', auth()->user()->id)->update(['phone_number' => $request->phone]);
            return redirect()->to('/phone-validation')->with('code', $request->valid_code)->with('phone', $request->phone)->with('success', 'Phone validation successfully');;
        } else {
            return redirect()->to('/phone-validation')->with('code', $request->valid_code)->with('phone', $request->phone)->with('message', 'Phone validation failed');;
        }
    }
    public function sendSmsNotification (Request $request) {
        $code = rand(1231,7879);
        $phone = "88$request->phone";
        $basic  = new \Vonage\Client\Credentials\Basic("6f35a245", "Uy37Jja5a4clcRAS");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS('8801747102896', 'bindaas', "Your verification code is $code")
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            return redirect()->to('/phone-validation')->with('code', $code)->with('phone', $phone);
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
        // return view('auth.phone_validation', compact('code'));
    }
    public function phone () {
        return view('auth.phone');
    }
}
