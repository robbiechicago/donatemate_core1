<?php

namespace App\Http\Controllers;

use App\Org;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Env;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\Cast\Object_;


class OrgController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $orgs = Org::where('active', 1)->orderBy('display_name')->get();

        return view('org.index')->with([
            'orgs' => $orgs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('org.form')->with([
            'org' => NULL
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
            'org_name' => [
                'required',
                'unique:orgs'
            ],
            'display_name' => [
                'required',
                'unique:orgs'
            ],
            'charity_number' => [
                'nullable',
                'numeric',
                'unique:orgs'
            ],
            'active' => [
                'boolean'
            ]
        ]);

        $org = new Org();
        $org->org_name = $request->org_name;
        $org->display_name = $request->display_name;
        $org->charity_number = $request->charity_number;
        $org->org_hash = md5(uniqid($request->org_name, true));
        $org->active = $request->active == 1 ? 1 : 0;

        if ($org->save()) {
            return redirect('/org/' . $org->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $org = Org::with(['users', 'donations', 'devices.org'])->find($id);

        $base_url = env('APP_URL');

        return view('org.show')->with([
            'org' => $org,
            'base_url' => $base_url,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $org = Org::find($id);

        return view('org.form')->with([
            'org' => $org
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Redirector
     */
    public function update(Request $request, $id)
    {
        $org = Org::find($id);

        $request->validate([
            'org_name' => [
                'required',
                Rule::unique('orgs')->ignore($org->id),
            ],
            'display_name' => [
                'required',
                Rule::unique('orgs')->ignore($org->id),
            ],
            'charity_number' => [
                'nullable',
                'numeric',
                Rule::unique('orgs')->ignore($org->id),
            ],
            'active' => [
                'boolean'
            ]
        ]);

        $org->org_name = $request->org_name;
        $org->display_name = $request->display_name;
        $org->charity_number = $request->charity_number;
        $org->active = $request->active == 1 ? 1 : 0;

        if ($org->save()) {
            return redirect('/org/' . $org->id);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
