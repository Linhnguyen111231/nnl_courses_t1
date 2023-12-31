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
        $search = Course::where('name','LIKE','%'.$request->key.'%');
        if ($request->sort == 'increaseName') {
            $search= $search->orderBy('name','asc');
        }else if ($request->sort == 'reduceName') {
            $search= $search->orderBy('name','desc');

        }
        $search= $search->paginate(2, ['*'], 'page', $request->page);
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
            'name'=> 'required|max:191',
            'startdate'=>'required',
            'enddate'=>'required',
            'description'=>'required|max:191',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'validate'=>$validate->errors()->messages(),
            'result'=>false
            ]);
        }else{
            $course = new Course($request->all());
        $course->save();
        return response()->json([

            'result'=>true
        ]); 
        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return response()->json([
            'course'=> $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
           
            return response()->json([
                
                'success'=>true
            ]);
            
        } catch (\Throwable $th) {
        $courses = Course::all();
            
            return response()->json([
                
                'success'=>false
            ]);
        }         
        
    }
    public function delete(Request $request)
    {
        
        try {
            Course::whereIN('id',$request->arr)->delete();
           
            return response()->json([
                
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
