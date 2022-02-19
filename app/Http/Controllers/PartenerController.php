<?php

namespace App\Http\Controllers;

use App\Partener;
use App\PartenershipActivity;
use Illuminate\Http\Request;

class PartenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexIndistruel()
    {
        $parteners = Partener::get()->where('partner_type','industriel');

        return view('backend.parteners.index', compact('parteners'));
    }
    public function indexAcademique()
    {
        $parteners = Partener::get()->where('partner_type','academique');

        return view('backend.parteners.index', compact('parteners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        

        return view('backend.parteners.create');
        
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
            'Nom'          => 'required|string|max:255|unique:subjects',
            'presentation'  => 'required|string',
            'partnership_type'  => 'required|string',
            'partnership_status'  => 'required|string',
            'partner_type'    => 'required|numeric',
            'is_partenerOfYear'   => 'required|string|max:255'
        ]);

        Partener::create([
            'Nom'           => $request->nom,
            'presentation'  => $request->presentation,
            'partnership_type'=>$request->partnership_type,
            'partnership_status'=>$request->partnership_type,
            'partner_type'=>$request->partner_type,
            'is_partenerOfYear'    => $request->is_partenerOfYear,
            
        ]);
        if($request->partner_type=='academique')
        return redirect()->route('parteners.index2');
        else{
        return redirect()->route('parteners.index1');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partener  $partener
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $partener=Partener::get()->where('id',$id);
        $pActs=PartenershipActivity::get()->where('partener_id',$id);
        return view('backend.partener.details', compact('partener','pActs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partener  $partener
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $partener=Partener::get()->where('id',$id);
        return view('backend.partener.edit', compact('partener'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partener  $partener
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partener $partener)
    {
        $request->validate([
            'Nom'          => 'required|string|max:255|unique:subjects',
            'presentation'  => 'required|string',
            'partnership_type'  => 'required|string',
            'partnership_status'  => 'required|string',
            'partner_type'    => 'required|numeric',
            'is_partenerOfYear'   => 'required|string|max:255'
        ]);

        $partener->update([
            'Nom'           => $request->nom,
            'presentation'  => $request->presentation,
            'partnership_type'=>$request->partnership_type,
            'partnership_status'=>$request->partnership_type,
            'partner_type'=>$request->partner_type,
            'is_partenerOfYear'    => $request->is_partenerOfYear,
            
        ]);
        if($request->partner_type=='academique')
        return redirect()->route('parteners.index2');
        else{
        return redirect()->route('parteners.index1');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partener  $partener
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $partener=Partener::get()->where('id',$id);
        $partener->delete();

        return back();
    }
}
