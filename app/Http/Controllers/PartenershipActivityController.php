<?php

namespace App\Http\Controllers;

use App\Partener;
use App\PartenershipActivity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class PartenershipActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parteners=Partener::with('partner')->latest()->paginate(10);
        return view('backend.partenershipActivity.create',compact('parteners'));
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
            'Date'  => 'required|string',
            'Type'    => 'required|string',
            'Description'   => 'required|string|max:255',
            'partener_id' =>'required|numeric'
        ]);

        PartenershipActivity::create([
            'Title'           => $request->title,
            'date'          => $request->date,
            'type'    => $request->type,
            'Description'   => $request->description,
            'partener_id'=> $request->partener_id
        ]);

        return redirect()->route('parteners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PartenershipActivity  $partenershipActivity
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $partenershipActivity=PartenershipActivity::get()->where('id',$id);
        return view('backend.filieres.details', compact('partenershipActivity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PartenershipActivity  $partenershipActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $pact=PartenershipActivity::get()->where('id',$id);
        $parteners=Partener::with('partner')->latest()->paginate(10);
        return view('backend.partenershipActivity.edit', compact('pact','parteners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PartenershipActivity  $partenershipActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartenershipActivity $partenershipActivity)
    {
        $request->validate([
            'Title'          => 'required|string|max:255|unique:subjects',
            'Date'  => 'required|string',
            'Type'    => 'required|string',
            'Description'   => 'required|string|max:255',
            'partener_id' =>'required|numeric'
        ]);

        $partenershipActivity->update([
            'Title'           => $request->title,
            'date'          => $request->date,
            'type'    => $request->type,
            'Description'   => $request->description,
            'partener_id'=> $request->partener_id
        ]);

        return redirect()->route('parteners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PartenershipActivity  $partenershipActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $pact=PartenershipActivity::get()->where('id',$id);
        $pact->delete();

        return back();
    }
}
