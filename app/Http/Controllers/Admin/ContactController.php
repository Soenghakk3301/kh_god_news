<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Language;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.contact-page.index', compact('languages'));
    }

    public function update(Request $request)
    {
        Contact::updateOrCreate(
            [
              'language' => $request->language,
            ],
            [
              'address' => $request->address,
              'phone' => $request->phone,
              'email' => $request->email
            ]
        );

        toast(__('Updated Successfull!'), 'sucess');

        return redirect()->bakc();
    }
}