<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $search = Course::where('name','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            'search'=> $search
        ]);

    }
    public function index()
    {
        $courses = Course::all();
        return view('tablecourses')->with('courses',$courses);
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
        $validate = Validator::make($request->all(),[
            'name'=> 'required:max:191',
            'description'=>'required:max:191',
        ]);
        if ($validate->failed()) {
            return response()->json([
                'validate'=>$validate->errors()->messages(),
            'success'=>false
            ]);
        }
        $course = new Course($request->all());
        $course->save();
        $courses = Course::all();
        return response()->json([
            'courses'=> $courses,
            'success'=>true
        ]);
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
        $validate = Validator::make($request->all(),[
            'name'=> 'required:max:191',
            'description'=>'required:max:191',
        ]);
        if ($validate->failed()) {
            return response()->json([
                'validate'=>$validate->errors()->messages(),
            'success'=>false

            ]);
        }
        $course = Course::find($id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->startdate = $request->startdate;
        $course->enddate = $request->enddate;
        $course->save();
        $courses = Course::all();
        return response()->json([
            'courses'=> $courses,
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            Course::find($id)->delete();
            $courses = Course::all();
            return response()->json([
                'courses'=> $courses,
                'success'=>true
            ]);
            
        } catch (\Throwable $th) {
        $courses = Course::all();
            
            return response()->json([
                'courses'=> $courses,
                'success'=>false
            ]);
        }         
        
    }
    public function delete($arr)
    {
        
        try {
            Course::whereIN('id',$arr)->delete();
            $courses = Course::all();
            return response()->json([
                'courses'=> $courses,
                'success'=>true
            ]);
            
        } catch (\Throwable $th) {
        $courses = Course::all();
            
            return response()->json([
                'courses'=> $courses,
                'success'=>false
            ]);
        }         
        
    }
}
