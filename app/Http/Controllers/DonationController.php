<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{

    public function donate(Request $request) {

        $user = Auth::user();

        //ADD VALIDATION

        Log::info('donate', ['user' => $user]);

        $donation = new Donation();
        $donation->org_id = $request->org_id;
        $donation->user_id = $user->id;
        $donation->amount = $request->amount;
        $donation->status = 'pending';

        if (!$donation->save()) {
            return response()->json([
                'success' => false,
                'message' => 'DONATION_FAILED'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'DONATION_RECIEVED'
        ], 200);
    }

    public function get_user_donations() {

        $user = Auth::user();

        Log::info('get_user_donations', ['user' => $user]);

        $donations = Donation::with('org')->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'message' => 'FOUND',
            'data' => [
                'donations' => $donations
            ]
        ]);

    }
}
