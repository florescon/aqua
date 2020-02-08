<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\Section;
use App\ClassroomType;
use App\Models\Auth\User;
use App\Tag;
use App\Http\Requests\ClassRequest;
use App\Http\Requests\ClassUpdateRequest;

class ClassroomController extends Controller
{
    public function index(){
 
    	$classes = Classroom::with('students')->orderBy('updated_at', 'desc')->paginate();
    	// $sections = Section::all();
        // $classrooomtype = ClassroomType::all();
    	// $users = User::whereConfirmedAndActiveAndDeleted_at(true, true, NULL)->get();
        // $tags = Tag::whereType(1)->get();
    	return view('backend.class.class.index', compact('classes'));
    }


    public function store(ClassRequest $request)
    {
    
        $class = new Classroom();
        $class->name = $request->name;
        $class->section_id = $request->section;
        $class->classroom_type_id = $request->classtype;
        $class->user_id = $request->instructor;
        $class->schedule = $request->schedule;
        $class->days = $request->days;
        $class->save();
        
        $class->students()->attach($request->input('users'));
        $class->tags()->attach($request->input('tags'));

	return redirect()->route('admin.class.class.index')
      ->withFlashSuccess('Clase guardada con éxito');
    }

    public function update(ClassUpdateRequest $request)
    {
        $class = Classroom::findOrFail($request->sub);
        $class->update($request->all());
       
        return back()->withFlashSuccess('Clase actualizada con éxito');

    }

    public function destroy($id)
    {
        $class = Classroom::findOrFail($id);
        $class->delete();

        return redirect()->route('admin.class.class.index')->withFlashSuccess('Clase eliminada con éxito');
    }

}
