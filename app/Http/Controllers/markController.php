<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;

class markController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentMarks = Mark::all();
        return view('marks.list', compact('studentMarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::pluck('id', 'name');
        $terms = Term::pluck('id', 'term');
        return view('marks.create', compact('students', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marks = request()->validate([
            'student_id' => ['required'],
            'term_id' => ['required'],
            'maths' => ['required', 'integer'],
            'science' => ['required', 'integer'],
            'computer' => ['required', 'integer'],
        ]); 
        Mark::create($marks);
        return redirect()->route('mark.index')
                         ->with('message', 'Marks added successfully');
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
        $studentsMark = Mark::find($id);
        $students = Student::pluck('id', 'name');
        $terms = Term::pluck('id', 'term');
        return view('marks.edit', compact('studentsMark', 'students', 'terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        $marks = request()->validate([
            'student_id' => ['required'],
            'term_id' => ['required'],
            'maths' => ['required', 'integer'],
            'science' => ['required', 'integer'],
            'computer' => ['required', 'integer'],
        ]); 
        $mark->update($marks);
        return redirect()->route('mark.index')
                         ->with('message', 'Marks Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentMark = Mark::find($id);
        $studentMark->delete();
        return redirect()->route('mark.index')
                         ->with('message', 'Marks deleted successfully');
    }
}
