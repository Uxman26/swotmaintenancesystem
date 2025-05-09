<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('site.contact_us');
    }
    public function contact(Request $request)
    {
        $name    = $request->get('name');
        $email   = $request->get('email');
        $subject = $request->get('subject');
        $message = $request->get('message');

        // Form validation
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->getMessages() as $validationErrors) {
                session()->flash('error', $validationErrors[0]);
                return redirect()->back();
            }
        }

        if ($message != "") {
            $ticket          = new Ticket();
            $ticket->name    = $name;
            $ticket->email   = $email;
            $ticket->subject = $subject;
            $ticket->message = $message;
            $ticket->save();
        }


        session()->flash('success', 'Message sent successfully.');
        return redirect()->back();
    }
}


