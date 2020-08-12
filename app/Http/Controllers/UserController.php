<?php

namespace App\Http\Controllers;

use App\Org;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users = User::orderBy('last_name')->get();

        return view('user.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $org_id = NULL;
        if (isset($_GET['org_id'])) {
            $org_id = $_GET['org_id'];
        }

        $orgs = Org::where('active', 1)->orderBy('org_name')->get();

        return view('user.form')->with([
            'user' => NULL,
            'orgs' => $orgs,
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
            'first_name' => [
                'required'
            ],
            'last_name' => [
                'required'
            ],
            'email' => [
                'email',
                'unique:users'
            ],
            'org_id' => [
                'required',
                'numeric'
            ]
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->org_id = $request->org_id === '99999' ? NULL : $request->org_id;
        $user->access_level = 10;

        if ($user->save()) {
            return redirect('/user/' . $user->id);
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
        $user = User::with('org')->find($id);

        return view('user.show')->with([
            'user' => $user
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
        $user = User::find($id);
        $orgs = Org::orderBy('org_name')->get();

        return view('user.form')->with([
            'user' => $user,
            'orgs' => $orgs
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
        $user = User::find($id);

        $request->validate([
            'first_name' => [
                'required'
            ],
            'last_name' => [
                'required'
            ],
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'org_id' => [
                'required',
                'numeric'
            ]
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->org_id = $request->org_id === '99999' ? NULL : $request->org_id;
        $user->access_level = 10;

        if ($user->save()) {
            return redirect('/user/' . $user->id);
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
