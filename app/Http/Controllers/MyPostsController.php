<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Models\Post;
use App\Models\Category;
use App\Models\Base;
use App\Models\User;
use Session;

class MyPostsController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */



    public function index()
    {
        $idUser=session()->get('user')->id_user;
        $model=new Post();
        $allPosts=$model->getAllPostsOfOneUser(session()->get('user')->id_user);
        return view('pages.my_posts',["posts"=>$allPosts],$this->data);
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
        return view('pages.new_post',['categories'=>$categories],$this->data);

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
            return redirect(route('user_posts.create'));
        }catch(\Exception $e){
            \Log::error("There was an error : " . $e->getMessage());
            \DB::rollBack();
            session()->flash('alert-danger', 'Error while creatig a post contact administartor');
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
        $model=new Post();
        $allPosts=$model->getAllPostsOfOneUser($id);
        $modelUser=new User();
        $user=$modelUser->getUserById($id);
        return view('pages.my_posts',["posts"=>$allPosts,"user"=>$user,"id"=>$id],$this->data);
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
        return view('pages.new_post',['categories'=>$categories,"post"=>$post],$this->data);
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
            return redirect()->back();
        }catch(\Exception $e){
            \Log::error("There was an error while updating: " . $e->getMessage());
            \DB::rollBack();
            session()->flash('alert-danger', 'Error while updating a post contact administartor');
            return redirect();
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
//            \Log::error("There was an error while deliting a post: " . $ex->getMessage());
            session()->flash('alert-danger', 'Error while deleting a post, contact administaror');
            return redirect()->back();
        }
    }
}
