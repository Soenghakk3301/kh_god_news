<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\RecievedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function index()
    {
        RecievedMail::query()->update(['seen' => 1]);
        $messages = RecievedMail::all();

        return view('admin.contact-message.index', compact('messages'));
    }


    /** send reply to a specific email */
    public function sendReply(Request $request)
    {


        $request->validate([
           'subject' => 'required|max:255',
           'message' => 'required',
        ]);

        try {
            $contact = Contact::where('language', 'en')->first();

            /** send mail */
            Mail::to($request->email)->send(new ContactMail($request->subject, $request->message, $contact->email));

            toast(__('Mail send Successfully!'), 'success');

            return redirect()->back();


        } catch (\Throwable $th) {
            toast($th->getMessage(), 'success');

            return redirect()->back();
        }
    }
}