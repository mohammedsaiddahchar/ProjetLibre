<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Filiere;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filieres=Filiere::with('filiere')->latest()->paginate(10);
        return view('backend.Activity.create',compact('filieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Title'          => 'required|string|max:255|unique:subjects',
          
            'Details'    => 'required|string',
            'Description'   => 'required|string|max:255',
            'filiere_id' =>'required|numeric'
        ]);

        Activity::create([
            'Title'           => $request->title,
            
            'details'    => $request->details,
            'Description'   => $request->description,
            'filiere_id'=> $request->filiere
        ]);

        return redirect()->route('filieres.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $activity=Activity::get()->where('id',$id);
        return view('backend.activities.details', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $act=Activity::get()->where('id',$id);
        $filieres=Filiere::with('filiere')->latest()->paginate(10);
        return view('backend.activities.edit', compact('act','filieres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'Title'          => 'required|string|max:255|unique:subjects',
          
            'Details'    => 'required|string',
            'Description'   => 'required|string|max:255',
            'filiere_id' =>'required|numeric'
        ]);

       $activity->update([
            'Title'           => $request->title,
            
            'details'    => $request->details,
            'Description'   => $request->description,
            'filiere_id'=> $request->filiere
        ]);

        return redirect()->route('filieres.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $act=Activity::get()->where('id',$id);
        $act->delete();

        return back();
    }
}
