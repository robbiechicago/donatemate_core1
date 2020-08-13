<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DeviceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $org_id = NULL;
        if (!isset($_GET['org_id']) || !is_numeric($_GET['org_id'])) {
            return back()->with('error', 'Invalid Organisation ID');
        }
        $org_id = $_GET['org_id'];

        return view('device.form')->with([
            'device' => NULL,
            'org_id' => $org_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'org_id' => [
                'required',
            ],
            'name' => [
                'required'
            ],
            'description' => [
                'nullable'
            ],
            'suggested_donation' => [
                'nullable',
                'numeric',
                'min:1'
            ]
        ]);

        $user = Auth::user();

        $device = new Device();
        $device->device_hash = md5(uniqid($request->name, true));
        $device->org_id = $request->org_id;
        $device->type = 1;
        $device->name = $request->name;
        $device->description = $request->description;
        $device->suggested_donation = $request->suggested_donation;
        $device->created_by = $user->id;

        if ($device->save()) {
            return redirect('/org/' . $device->org_id);
        }
    }

    /**
     * API get org by org_hash and device_hash.
     *
     * @param  string  $device_hash
     * @param  string  $org_hash
     * @return JsonResponse
     */
    public function get_device(string $device_hash, string $org_hash)
    {
        $device = Device::with(['org' => function($query) use ($org_hash) {
            $query->where('org_hash', $org_hash);
        }])->where('device_hash', $device_hash)->first();

        if (!$device) {
            return response()->json([
                'success' => false,
                'message' => 'DONATION_FAILED'
            ], 200);
        }

        $return_device = [
            'device_id' => $device->id,
            'device_name' => $device->name,
            'device_desc' => $device->description,
            'suggested_donation' => $device->suggested_donation,
            'org_id' => $device->org->id,
            'org_display_name' => $device->org->display_name,
            'charity_number' => $device->org->charity_number,
            'image_filename' => $device->org->image_filename,
            'image_url' => $device->org->image_url,
        ];

        return response()->json([
            'success' => true,
            'message' => 'FOUND',
            'data' => [
                'device' => $return_device
            ]
        ]);

    }
}
