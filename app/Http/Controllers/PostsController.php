<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class PostsController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPostsWithPagination(Request $request){
        $model = new Post();
        $posts = $model->getAllPosts();
        if($request->ajax()){
            $view=view('partials.post',['posts'=>$posts]);
            return response()->json([
                "status"=>"ok",
                "posts"=>$view->render(),
            ]);
        }
//        dd($posts);
        return view("pages.home",["posts"=>$posts],$this->data);

    }


    public function getAllPostsFromOneCategory(Request $request,$id){
        $model=new Post();
        $all_posts_from_cat=$model->getAllPostsFromOneCategory($id);
        $modelCat=new Category();
        $name=$modelCat->getCatName($id);
        if($request->ajax()){
            $view=view('partials.post',['posts'=>$all_posts_from_cat]);
            return response()->json([
                "status"=>"ok",
                "posts"=>$view->render(),
            ]);
        }
        return view("pages.post_category",["posts"=>$all_posts_from_cat,"name"=>$name],$this->data);
    }

    public function getOnePost($id){
        $model=new Post();
        $modelComment=new Comment();
        $onePost=$model->getOnePostAllDetails($id);
        $comments=$modelComment->getPostComments($id);
        $model->addView($id);
        return view("pages.one_post",["post"=>$onePost,"comm"=>$comments],$this->data);

    }
}
