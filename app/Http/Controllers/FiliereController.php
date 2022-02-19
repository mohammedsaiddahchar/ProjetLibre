<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Filiere;
use App\Teacher;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filieres = Filiere::with('teacher')->latest()->paginate(10);

        return view('backend.filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::get();

        return view('backend.filieres.create', compact('teachers'));
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
            'code'  => 'required|string',
            'id_teacher'    => 'required|numeric',
            'Description'   => 'required|string|max:255'
        ]);

        Filiere::create([
            'Nom'           => $request->name,
            'code'          => $request->code,
            'id_teacher'    => $request->id_teacher,
            'Description'   => $request->description
        ]);

        return redirect()->route('filiere.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $filiere=Filiere::get()->where('id',$id);
        $teacher=Teacher::get()->where('user_id',$filiere->id_teacher);
        $actvities=Activity::with('activity')->latest()->paginate(10);
        return view('backend.filiere.details', compact('filiere','teacher','activities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $filiere=Filiere::get()->where('id',$id);
        $teachers = Teacher::with('user')->latest()->paginate(10);
        return view('backend.filiere.edit', compact('filiere','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filiere $filiere)
    {
      $request->validate([
            'Nom'          => 'required|string|max:255|unique:subjects',
            'code'  => 'required|string',
            'id_teacher'    => 'required|numeric',
            'Description'   => 'required|string|max:255'
        ]);

        $filiere->update([
            'Nom'           => $request->name,
            'code'          => $request->code,
            'id_teacher'    => $request->id_teacher,
            'Description'   => $request->description
        ]);

        return redirect()->route('filiere.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $filiere=Filiere::get()->where('id',$id);
        $filiere->delete();

        return back();
    }
}
