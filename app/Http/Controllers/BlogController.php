<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Http\Resources\BlogResource as BlogResource;

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
        $data = $request->all();
        if ($this->blogRepo->create($data)) {
            return response()->json($data, 201);
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

    public function update(Request $request,$id)
    {
        $data = $request->all();
        if ($this->blogRepo->update($id, $data)) {
            return response()->json($data, 200);
        } else {
            return false;
        }
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


}
