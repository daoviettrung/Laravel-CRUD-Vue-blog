<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Http\Resources\BlogResource as BlogResource;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    protected $blogRepo;

    /**
     * set BlogRepositoryInterface is $blogRepo
     */
    public function __construct(BlogRepositoryInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = $this->blogRepo->getAll();
        return BlogResource::collection($blog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required | min : 2 | max: 100',
            'des' => 'required | min : 2 | max: 100',
            'detail' => 'required | min : 2 | max: 100'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }
        $data = $request->all();
        if ($this->blogRepo->create($data)) {
            return BlogResource::collection($data);
        } else {
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {
        $blog = $this->blogRepo->find($param);
        return BlogResource::collection($blog);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required | min : 2 | max: 100',
            'des' => 'required | min : 2 | max: 100',
            'detail' => 'required | min : 2 | max: 100'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }
        $data = $request->all();
        if ($this->blogRepo->update($id, $data)) {
            return BlogResource::collection($data);
        }
            return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->blogRepo->destroy($id)) {
            return response()->json(null, 204);
        } else {
            return false;
        }
    }

    public function search($title){
        if ($this->blogRepo->search($title)) {
            return BlogResource::collection($title);
        } 
            return false;
    }
}
