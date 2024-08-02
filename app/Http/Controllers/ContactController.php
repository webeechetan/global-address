<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->alert('Welcome to the contact page', 'This is the contact page', 'info');
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits_between:7,12',
            'city' => 'required',
        ];

        $messages = [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email address must be a valid email format.',
            'phone.required' => 'Please enter your phone number.',
            'phone.digits_between' => 'Phone number must be between 7 and 12 digits.',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->city = $request->city;
        $contact->utm_source = $request->utm_source;
        $contact->utm_medium = $request->utm_medium;
        $contact->utm_campaign = $request->utm_campaign;
        $contact->utm_link = $request->utm_link;
        $contact->utm_content = $request->utm_content;
        
        if($contact->save()) {
            // download sameple.pdf file
            $file = public_path()."/frontend/global_brochure.pdf";
            $headers = array(
                'Content-Type: application/pdf',
            );
            return response()->download($file, 'global_brochure.pdf', $headers);
        }
        return redirect()->route('viewIndex')->with('error', 'An error occurred. Please try again later.');
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            return redirect()->route('admin.contact')->with('success', 'Contact deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contact')->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function export(){
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }

}
