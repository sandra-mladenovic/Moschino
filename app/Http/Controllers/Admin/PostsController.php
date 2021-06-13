<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Services\PostService;
use Session;

class PostsController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      //  dd('sdasda');
        $model=new Post();
        $posts=$model->allPosts();
       return view("pages.admin.posts",['posts'=>$posts],$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model=new Category();
        $categories=$model->getAllCategories();
        return view("pages.admin.post_form",['categories'=>$categories],$this->data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try{
            \DB::beginTransaction();
            $postService = new PostService();
            $postService->insertPost($request);
            \DB::commit();
            session()->flash('alert-success', 'Post created successfully');
            return redirect(route('posts.index'));
        }catch(\Exception $e){
            \Log::error("There was an error : " . $e->getMessage());
            \DB::rollBack();
            session()->flash('alert-danger', 'Error contact administrator');
            return redirect()->back();
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
        $model=new Post();
        $post=$model->getOnePostAllDetails($id);
        $model=new Category();
        $categories=$model->getAllCategories();
        return view('pages.admin.post_form',['categories'=>$categories,"post"=>$post],$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try{
            \DB::beginTransaction();
           $postService = new PostService();
           $postService->updatePost($request,$id);
           \DB::commit();
           session()->flash('alert-success', 'Post updated successfully');
           return redirect(route('posts.index'));
       }catch(\Exception $e){
            \Log::error("There was an error while updating: " . $e->getMessage());
           \DB::rollBack();
           return redirect()->back()->with("errors", "Error while updating post, contact administrator.");
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
        try{
            $postService=new PostService();
            $postService->deletePost($id);
            session()->flash('alert-success', 'Post deleted');
            return redirect()->back();
        }catch(\Exception $ex){
            \Log::error("There was an error while deliting a post: " . $ex->getMessage());
            return redirect()->back()->with("error", "Error while deliting post, contact administrator.");
        }
    }
}
