<?php

namespace Figtest\Http\Controllers;

use Illuminate\Http\Request;
use Figtest\Http\Requests\BlogRequest;
use Figtest\Services\BlogService;
use Auth;

class BlogController extends Controller
{
    /**
     * @var BlogService
     */
    protected $blogService;

    /**
     * BuilderController constructor.
     */
    public function __construct(BlogService $blogService)
    {
        $this->middleware(['auth'])->except('index', 'show', 'create', 'edit');
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->blogService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        return response()->json($this->blogService->createBlog($request->all(), Auth::user()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $blogId
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, string $blogId)
    {
        $blog = $this->blogService->getOne($blogId);

        // check if the authenticated user can match the task. The second param must be an object.
        // After add policy, it must be registered in he AuthServiceProvider.php
        $this->authorize('match', $blog);
        $this->blogService->updateBlog($request->all(), $blog);

        return response()->json($this->blogService->getOne($blogId));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $blogId
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $blogId)
    {
        $blog = $this->blogService->getOne($blogId);

        // check if the authenticated user can match the blog. The second param must be an object.
        $this->authorize('match', $blog);  
        $blog->delete();

        return response()->json($this->blogService->getAll());
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $blogId
     * @return \Illuminate\Http\Response
     */
    public function show(string $blogId)
    {
        return response()->json($this->blogService->getOne($blogId));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
}
