<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendFileNotification;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->alert('Welcome to the contact page', 'This is the contact page', 'info');
        // $contacts = Contact::all();
        $contacts = Contact::orderBy('created_at', 'desc')->get();
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
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|digits:10|unique:contacts',
            'state' => 'required',
            'city' => 'required',
        ];

        $messages = [
            'name.required' => 'Please enter your name.',
            'name.regex' => 'Name must contain only alphabets and spaces.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email address must be a valid email format.',
            'phone.required' => 'Please enter your phone number.',
            'phone.digits' => 'Phone number must be exactly 10 digits.',
            'email.unique' => 'The email address is already registered.',
            'phone.unique' => 'The phone number is already registered.',
            'state.required' => 'Please Select the State.',
            'city.required' => 'Please Select  your city.',
        ];

        // Validate the request
        $request->validate($rules, $messages);
    
        $contact = new Contact();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->state = $request->state;
        $contact->city = $request->city;
        $contact->utm_source = $request->utm_source;
        $contact->utm_medium = $request->utm_medium;
        $contact->utm_campaign = $request->utm_campaign;
        $contact->utm_link = $request->utm_link;
        $contact->utm_content = $request->utm_content;
        
        if($contact->save()) {
            
            try {
                Notification::route('mail', $contact->email)
                    ->notify(new SendFileNotification($contact->name, $contact->email, $contact->phone));
                     return redirect()->route('viewIndex')->with('success', 'You will receive the brochure via email.');
                    

            } catch (\Exception $e) {
                \Log::error('Notification error: '.$e->getMessage());

                return redirect()->back();
            }
           
        }
        return redirect()->route('viewIndex')->with('error', 'An error occurred. Please try again later.');
     
    }

    // public function checkEmail(Request $request){
    //     $email = $request->email;
    //     $contact = Contact::where('email', $email)->first();
    //     if($contact){
    //         return response()->json(['status' => 'true', 'message' => 'The email address is already registered.']);
    //     }
    //     return response()->json(['status' => 'false', 'message' => 'The email address is available.']);
    // }

    // public function checkPhone(Request $request){
    //     $phone = $request->phone;
    //     $contact = Contact::where('phone', $phone)->first();
    //     if($contact){
    //         return response()->json(['status' => 'true', 'message' => 'The phone number is already registered.']);
    //     }
    //     return response()->json(['status' => 'false', 'message' => 'The phone number is available.']);
    // }

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

    
    public function getCities($stateId)
    {

        $cities = City::where('state_id', $stateId)->get();
       
        return response()->json(['cities' => $cities]);
    }

}
