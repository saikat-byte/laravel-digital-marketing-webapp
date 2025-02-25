<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;
use App\Models\Lead;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        //Validate
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name' => 'nullable|string|max:255',
        ]);

        // Subscribers table data save into database
        $name = $request->name ?: 'Subscriber';
        $subscriber = Subscriber::create([
            'name' => $name,
            'email' => $request->email,
        ]);

        // CRM lead data save into database

        $crmLead = Lead::create([
            'name' => $subscriber->name,
            'email' => $subscriber->email,
        ]);

        //  App Kit API data send to App Kit

        $endpoint = env('KIT_API_ENDPOINT') . '/forms/' . env('KIT_FORM_ID') . '/subscribe?api_key=' . env('KIT_API_KEY');
        try {
            $response = Http::timeout(60)->withHeaders([
                'Authorization' => 'Bearer ' . env('APPKIT_API_KEY'),
                'Accept' => 'application/json',
            ])->post($endpoint, [
                        'email' => $subscriber->email,
                        'name' => $subscriber->name,
                    ]);

            if (!$response->successful()) {
                Log::error('App.Kit API error: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('App.Kit API Exception: ' . $e->getMessage());
        }

        //CRM API send lead data to CRM system.

        $crmUrl = 'https://cloudspace.crmgro.com/API/AddLead';
        $crmData = [
            'employee' => 'XXX',
            'lead_source' => 'WebsiteForm',
            'mobile' => '',
            'company_name' => '',
            'person' => $subscriber->name,
            'email' => $subscriber->email,
            'address' => '',
            'remark' => 'Came from subscription form',
            'lead_type' => 'Warm',
        ];

        try {
            $crmResponse = Http::get($crmUrl, $crmData);

            if ($crmResponse->successful()) {
                $res = $crmResponse->json();
                if (!empty($res['success']) && $res['success'] === true) {

                    // CRM lead entry success
                    if (!empty($res['lead']['id'])) {
                        $crmLead->crm_lead_id = $res['lead']['id'];
                        $crmLead->save();
                    }
                } else {
                    // CRM to success=false
                    Log::error('CRM API error: ' . ($res['message'] ?? 'No message'));
                }
            } else {
                // If HTTP status is not 200
                Log::error('CRM API Request failed, status: ' . $crmResponse->status());
            }
        } catch (\Exception $e) {
            Log::error('CRM API Exception: ' . $e->getMessage());
        }

        //Send email to subscriber
        Mail::to($subscriber->email)->send(new SubscriptionConfirmation($subscriber));

        //JSON response redirect
        return response()->json([
            'message' => 'Thank you for subscribing! Please check your email to view the file.'
        ], 200);
    }



}
