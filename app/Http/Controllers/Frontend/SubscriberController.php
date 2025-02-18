<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name'  => 'nullable|string|max:255',
        ]);

        //  name input, default assign
        $name = $request->name ?: 'Subscriber';

        $subscriber = Subscriber::create([
            'name'  => $name,
            'email' => $request->email,
        ]);

        // API Integration: App.Kit subscriber add
        $endpoint = env('KIT_API_ENDPOINT') . '/forms/' . env('KIT_FORM_ID') . '/subscribe?api_key=' . env('KIT_API_KEY');
        try {
            $response = Http::timeout(60)->withHeaders([
                'Authorization' => 'Bearer ' . env('APPKIT_API_KEY'),
                'Accept'        => 'application/json',
            ])->post( $endpoint, [
                'email' => $subscriber->email,
                'name'  => $subscriber->name, // using default value
            ]);

            if (!$response->successful()) {
                Log::error('App.Kit API error: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('App.Kit API Exception: ' . $e->getMessage());
        }


        // Send confirmation email with PDF attachment, etc.
        Mail::to($subscriber->email)->send(new SubscriptionConfirmation($subscriber));

        // Return JSON response if using AJAX
        return response()->json(['message' => 'Thank you for subscribing! A confirmation email has been sent.'], 200);
    }

}
