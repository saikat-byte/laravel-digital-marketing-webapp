<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeadController extends Controller
{
    public function submitLead(Request $request)
    {
        $name    = $request->input('name');
        $email   = $request->input('email');
        $phone   = $request->input('phone');
        $service = $request->input('service');


        // Data storage in my DB
        $lead = Lead::create([
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'service' => $service,
        ]);

        // Send data to CRM
        // CRM Api filed mapping with our form fields

        $crmData = [
            'employee'     => 'XXX',            // from client
            'lead_source'  => 'cloudspace',   // lead source
            'mobile'       => $phone,           //  phone field → CRM  mobile
            'company_name' => $service ?? 'N/A',// service field → CRM company_name
            'person'       => $name,            //  name → CRM person
            'email'        => $email ?? '',     // email → CRM email
            'address'      => '',               //
            'remark'       => 'Lead from form',
            'lead_type'    => 'XXX',
        ];

        // CRM API url
        $crmApiUrl = 'https://cloudspace.crmgro.com/API/AddLead';
        // generaly .env

        // HTTP GET request to CRM API
        try {
            $response = Http::get($crmApiUrl, $crmData);

            if ($response->successful()) {
                $resData = $response->json();

                // response JSON success field check
                if (!empty($resData['success']) && $resData['success'] === true) {
                    // Lead_id from CRM response
                    $crmLeadId = $resData['lead']['id'] ?? null;

                    if($crmLeadId) {
                        $lead->crm_lead_id = $crmLeadId;
                        $lead->save();
                    }

                    return redirect()->back()->with('success', 'Your details submited successfully!');
                } else {
                    // CRM response success=false
                    return redirect()->back()->with('error', 'CRM API call failed: '.$resData['message'] ?? 'Unknown error');
                }
            } else {
                // If HTTP status is not 200
                return redirect()->back()->with('error', 'API Request not successful. Status: '.$response->status());
            }
        } catch (\Exception $e) {
            // Exception handling
            return redirect()->back()->with('error', 'Exception: '.$e->getMessage());
        }
    }
}
