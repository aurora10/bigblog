<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends BackendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.home.index');
    }

    public function edit(Request $request) {
        $user = $request->user();
        return view('backend.home.edit', compact('user'));
    }

    public function update(Requests\AccountUpdateRequest $request) {
        $user = $request->user();
        $user->update($request->all());

        return redirect()->back()->with('message', 'Account was successfully updated');
    }
}
