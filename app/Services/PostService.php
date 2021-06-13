<?php
namespace App\Services;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\ImageService;
use App\Models\Post;
use App\Models\Base;
use Illuminate\Http\Request;

class PostService{

    public function insertPost(PostRequest $request){
        $image=$request->file('image');
        $uplader = new ImageService();
        $name = $uplader->uploadImage($image);
        $postModel = new Post();
        $id = $postModel->insertGetId($request,$name);
        $categories=$request->input('categories');
        $postModel->insertPostCat($categories,$id);
        $base=new Base();
        $base->logAction(session()->get('user')->id_user,"New Post");
    }

    public function updatePost(UpdatePostRequest $request,$id){
        $name=null;
        if($request->hasFile('image')){
            $uplader = new ImageService();
            $name = $uplader->uploadImage($request->file('image'));
        }
        $postModel=new Post();
        $postModel->updatePost($request,$id,$name);
        $postModel->deletePostCatWhileUpdating($request,$id);
        $base=new Base();
        $base->logAction(session()->get('user')->id_user,"Edit Post");
    }

    public function deletePost($id){
        $postModel=new Post();
        $postModel->deletePost($id);
        $base=new Base();
        $base->logAction(session()->get('user')->id_user,"Delete Post");
    }
}
