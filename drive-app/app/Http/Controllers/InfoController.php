<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use App\Models\User;

class InfoController extends Controller
{
    // Dashboard
    public function index() {
        $docs = Doc::latest()->limit(5)->get();
        $users = User::latest()->limit(5)->get();
        return view('index', ['docs' => $docs, 'users' => $users]);
    }
}
