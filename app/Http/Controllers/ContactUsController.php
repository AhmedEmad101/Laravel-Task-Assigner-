<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Contactor = $request->Contactor;
        session()->put('Contactor',$Contactor);
        return view('contactus');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactUsRequest $request)
    {
        $Contactor = session()->get('Contactor');
        $email = $request->email;
        $message = $request->message;
        $contact = ContactUs::create([
            'user_Id'=>$Contactor,
            'email'=>$email,
            'message'=>$message
        ]);
$contact->save();
return back()->with('contactsend','Your message has been sent to the admins and will reply to you soon');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
       return view('PartialViews.admin.Contacts');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
