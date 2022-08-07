<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Index page response
        $bms = Bookmark::latest()->filter(['user'])->paginate(6);

        return view('bookmarks.index', ['bms' => $bms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Check is already bookmarked
        $bms = Bookmark::all();
        foreach($bms as $bm) {
            if($bm->user_id == auth()->user()->id && $bm->doc_id == $request->query('doc')) {
                return back()->with('message', 'Already bookmarked!');
            }
        }
        
        // Store bookmark
        $bm = Bookmark::create(['user_id' => auth()->user()->id, 'doc_id' => $request->query('doc')]);
        return back()->with('message', 'Bookmarked!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        // Remove bookmark
        $bookmark->delete();

        return back()->with('message', 'Bookmark removed successfully!');
    }
}
