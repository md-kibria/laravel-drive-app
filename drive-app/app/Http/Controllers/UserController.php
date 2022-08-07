<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    // Index
    function index() {
        $users = User::get();
        return view('users.index', ['users' => $users]);
    }

    // Show profile
    function show(User $user) {
        return view('users.profile', ['user' => $user]);
    }

    // Update
    function update(Request $request, User $user) {

        // dd($request);

        $formFields = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'phone' => '',
            'address' => ''
        ]);

        if($request->hasFile('img')) {
            $formFields['img'] = $request->file('img')->store('images', 'public');
        }

        $user->update($formFields);

        return back()->with('message', 'User Updated successfully');
    }

    // Delete 
    function destroy(User $user) {

        if(!Auth::check()) {
            return back()->with('message', 'Your not loggedin');
        }
        
        if(!(Auth::check() && auth()->user()->id == $user->id)) {
            return back()->with('message', 'This is not your account');
        }

        // If user profile pic exist, delete it
        if($user->img) {
            Storage::disk('public')->delete($user->img);
        }

        $user->delete();

        return redirect('/users')->with('message', 'User deleted successfully');
    }

    // Register
    function register() {
        return view('users.register');
    }

    // Store user data
    function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Login user
        auth()->login($user);

        return redirect('/')->with('message', 'Register successfully');
    }

    // Logout 
    function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout successfully');
    }

    // Show login form
    function login() {
        return view('users.login');
    }

    // Authenticate
    function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {

            $request->session()->regenerate();

            return redirect('/')->with('message', 'Login successfull');
        }
        
        return back()->withErrors(['email' => 'Invalid creadentials'])->onlyInput('email');
    }
}
