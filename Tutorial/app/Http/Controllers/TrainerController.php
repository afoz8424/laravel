<?php

namespace Tutorial\Http\Controllers;

use Tutorial\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tutorial\Http\Requests\StoreTrainerRequest;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $trainers = Trainer::all();
        return view('trainers.index',compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainerRequest $request)
    {
        
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $avatar = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$avatar);
        }
        $trainer = new Trainer();
        $trainer->name = $request->input('name');
        $trainer->descripcion = $request->input('descripcion');
        $trainer->avatar = $avatar;
        $trainer->slug = str_slug($request->input('name'), '-');
        $trainer->save();
        //return 'Saved';
        return redirect()->route('trainers.index')->with('status','Registro Almacenado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        //$trainer = Trainer::where('slug','=',$slug)->firstOrFail();
        return view('trainers.show',compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        return view('trainers.edit',compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        $trainer->fill($request->except('avatar'));
        $trainer->slug = str_slug($request->input('name'), '-');
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $avatar = time().$file->getClientOriginalName();
            $trainer->avatar = $avatar;
            $file->move(public_path().'/images/',$avatar);
        }
        $trainer->save();
        //return 'Updated';
        return redirect()->route('trainers.show',[$trainer])->with('status','Registro Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
        $file_path = public_path().'/images/'.$trainer->avatar;
        \File::delete($file_path);
        $trainer->delete();
        return redirect()->route('trainers.index')->with('status','Registro Eliminado');
    }
}
