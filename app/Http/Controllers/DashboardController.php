<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($search = null)
    {
        $passwords = Password::where("user_id", auth()->id())->where('url', 'like', "%$search%")->latest()->get();

        return view('dashboard', compact(['passwords', 'search']));
    }

    public function create()
    {
        return view('password.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        // extract domain from url
        $domain = parse_url($request->url, PHP_URL_HOST);

        Password::create([
            'user_id' => auth()->id(),
            'url' => $request->url,
            'title' => $domain,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        return redirect()->route('dashboard')->with('success', 'Password created successfully');
    }

    public function edit($id)
    {
        $password = Password::where("user_id", auth()->id())->findOrFail($id);
        return view('password.edit', compact('password'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'url' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $password = Password::where("user_id", auth()->id())->findOrFail($id);

        // extract domain from url
        $domain = parse_url($request->url, PHP_URL_HOST);

        $password->update([
            'url' => $request->url,
            'title' => $domain,
            'username' => $request->username,
            'password' => $request->password,
            'notes' => $request->notes,
        ]);

        return redirect()->route('dashboard')->with('success', 'Password updated successfully');
    }

    public function delete($id)
    {
        // Delete the password
        $password = Password::where("user_id", auth()->id())->findOrFail($id);
        $password->delete();

        return redirect()->route('dashboard')->with('success', 'Password deleted successfully');
    }


    public function show($id)
    {
        $password = Password::where('user_id', auth()->id())->findOrFail($id);

        return view('password.show', compact('password'));
    }
}
