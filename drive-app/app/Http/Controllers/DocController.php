<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $docs = Doc::latest()->filter(request(['search', 'user']))->paginate(6);

        // If visit user's documents then add user id to parameter whene click on pagination link
        if($request->query('user')) {

            // $docs = Doc::latest()->filter(request(['search', 'user']))->where('privacy', 'public')->orWhere('privacy', 'private')->paginate(6);

            $docs->appends(['user' => $request->query('user')]);
        }

        // Is bookmark
        $bms = Bookmark::all();
        $bookmarks = array();
        
        if(Auth::check()) {
            foreach($bms as $bm) {
                if($bm->user_id == auth()->user()->id) {
                    array_push($bookmarks, $bm);
                }
            }
        }

        // dd($bookmarks);

        return view('docs.docs', ['docs' => $docs, 'bookmarks' => $bookmarks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('docs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'privacy' => 'required'
        ]);

        if($request->hasFile('file')) {
            // dd($request->file('file')->store('files', 'public'));
            $formFields['file'] = $request->file('file')->store('files', 'public');
        }
        
        $formFields['user_id'] = auth()->id();

        $doc = Doc::create($formFields);

        return redirect('/docs/' . $doc->id)->with('message', 'Document created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doc $doc)
    {
        $bms = Bookmark::all();

        $bookmark = false;
        foreach($bms as $bm) {
            if(Auth::check() && $bm->user_id == auth()->user()->id && $bm->doc_id == $doc->id) {
                $bookmark = $bm->id;
            }
        }

        return view('docs.doc', ['doc' => $doc, 'bookmark' => $bookmark]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doc $doc)
    {
        // return the edit form
        return view('docs.edit', ['doc' => $doc]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doc $doc)
    {

    // dd($request);

        // Validate form data
        $formFields = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'privacy' => 'required'
        ]);

        // dd(Auth::check() && auth()->user()->id );
        if(!Auth::check()) {
            return back()->with('message', 'Your not loggedin');
        }
        
        if(!(Auth::check() && auth()->user()->id == $doc->user_id)) {
            return back()->with('message', 'This is not your document');
        }

        if($request->hasFile('file')) {
            // dd($request->file('file')->store('files', 'public'));
            $formFields['file'] = $request->file('file')->store('files', 'public');
        }

        $doc->update($formFields);

        return back()->with('message', 'Document updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc $doc)
    {
        if(!Auth::check()) {
            return back()->with('message', 'Your not loggedin');
        }
        
        if(!(Auth::check() && auth()->user()->id == $doc->user_id)) {
            return back()->with('message', 'This is not your document');
        }

        if($doc->file) {
            // Storage::delete('/storage/'.$doc->file);
            Storage::disk('public')->delete($doc->file);
        }

        // delete
        $doc->delete();

        return redirect('/docs')->with('message', 'Document deleted successfully');
    }
}
