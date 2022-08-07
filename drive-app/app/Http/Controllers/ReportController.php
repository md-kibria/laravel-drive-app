<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index() {
        $reports = Report::latest()->get();

        return view('reports.reports', ['reports' => $reports]);
    }

    public function create() {
        return view('reports.report');
    }

    public function store(Request $request) {
        $form = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'msg' => 'required'
        ]);

        Report::create($form);

        return redirect('/')->with('message', 'You have reported successfully!');
    }

    public function destroy(Report $report) {

        if(!Auth::check()) {
            return back()->with('message', 'Your not loggedin');
        }

        // Delete the report
        $report->delete();

        return back()->with('messsage', 'Report deleted successfully');
    }
}
