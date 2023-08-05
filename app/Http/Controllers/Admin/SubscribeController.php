<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::all();
        return view('admin.subscriber.index', compact('subscribers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
         'subject' => 'required|max:255',
         'message' => 'required' ,
        ]);

        $subscribers = Subscriber::pluck('email')->toArray();

        /** send mails to subscribers */

        Mail::to($subscribers)->send(new Newsletter($request->subject, $request->message));

        toast(__('Mail sended successfully'), 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub = Subscriber::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }
}