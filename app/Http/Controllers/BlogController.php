<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();

        return response()->json([
            'status' => 'success',
            'data' => $blog
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        } else {
            $token = csrf_token();
            
            $blog = new Blog();

            $blog->title = $request->title;
            $blog->slug = $request->slug;
            $blog->description = $request->description;

            $blog->save();

            return response()->json([
                'status' => 'success',
                'data' => $blog
            ], 201);

        }

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong',            
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $blog
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        } else {
            $blog = Blog::findOrFail($id);

            $blog->title = request('title');
            $blog->slug = request('slug');
            $blog->description = request('description');
            
            $blog->save();

            return response()->json([
                'status' => 'success',
                'data' => $blog
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Blog deleted successfully'
        ], 200);
    }
}
