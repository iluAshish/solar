<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Book;
use App\Models\Franchise;
use App\Models\ImageGallery;
use App\Models\VideoGallery;
use DB;
use Carbon\Carbon;
use App\Mail\UserConfirmation;
use App\Mail\AdminNotification;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    public function __construct()
    {
        
    }
    public function home()
    {
        $data['data'] = ImageGallery::all();
         $data['video'] = VideoGallery::all();
        return view('welcome', $data);
    }
    public function login()
    {
       return view('login');
    }
    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'product' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
        ]);
    

        $existingBooking = Book::where('email', $request->email)->first();
        if ($existingBooking) {
            return redirect()->back()->with('error', 'You have already submitted a request.');
        }
    
        $booking = Book::create($request->all());
    
        try {
            // Send email to user
            Mail::to($booking->email)->send(new UserConfirmation($booking));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error sending email to user: ' . $e->getMessage());
        }
        
        try {
            // Send email to admin
            Mail::to('eeeshakhan30@gmail.com')->send(new AdminNotification($booking));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error sending email to admin: ' . $e->getMessage());
        }

    
        return redirect()->back()->with('success', 'Your request has been submitted. Our team will reach back you.');
    }
    public function storeFranchise(Request $request)
    {
        $request->validate([
            'occupation' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'city' => 'required',
            'state' => 'required',
            'location' => 'required',
            'investment' => 'required',
            'hear' => 'required',
            'interested' => 'required',
        ]);
    

        $existingBooking = Book::where('email', $request->email)->first();
        if ($existingBooking) {
            return redirect()->back()->with('error', 'You have already submitted a request.');
        }
    
        $booking = Book::create($request->all());
    
        try {
            // Send email to user
            Mail::to($booking->email)->send(new UserConfirmation($booking));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error sending email to user: ' . $e->getMessage());
        }
        
        try {
            // Send email to admin
            Mail::to('eeeshakhan30@gmail.com')->send(new AdminNotification($booking));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error sending email to admin: ' . $e->getMessage());
        }

    
        return redirect()->back()->with('success', 'Your request has been submitted. Our team will reach back you.');
    }
}
