<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;

class FrontendController extends Controller{

    protected $data = [];
    public function __construct(){
        $modelCat = new Category();
        $categories = $modelCat->getAllCategories();

        $modelPost = new Post();
        $recentPosts = $modelPost->getRecentPosts();

        $modelPopularPosts = new Post();
        $popularPosts = $modelPopularPosts->getPopularPosts();

        $this->data=[
            "categories"=>$categories,
            "recent_posts"=>$recentPosts,
            "popular_posts"=>$popularPosts
        ];
        return view('fixed.navigation');
    }

}
