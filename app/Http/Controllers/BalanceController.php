<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BalanceController extends Controller
{
    public function get_user_balance() {

        $user = Auth::user();

        $totalDeposits = Deposit::where('user_id', $user->id)->sum('amount');
        $totalDonations = Donation::where('user_id', $user->id)->sum('amount');

        return response()->json([
            'success' => true,
            'message' => 'FOUND',
            'data' => [
                'balance' => $totalDeposits - $totalDonations
            ]
        ]);
    }
}
