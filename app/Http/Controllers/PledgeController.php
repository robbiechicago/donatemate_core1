<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PledgeController extends Controller
{

    /**
     * Landing page for pledges
     *
     * @return View
     */
    public function pledge_landing()
    {
        if (!isset($_GET['org_hash']) || !isset($_GET['device_hash'])) {
            return 'bum';
        }

        $device_hash = $_GET['device_hash'];
        $org_hash = $_GET['org_hash'];

        $device = Device::with(['org' => function($query) use ($org_hash) {
            $query->where('org_hash', $org_hash);
        }])->where('device_hash', $device_hash)->first();

        if (!$device) {
            return 'NOT FOUND';
        }

//        return $device;
        return view('website.pledge.landing')->with([
            'device' => $device
        ]);

    }
}
