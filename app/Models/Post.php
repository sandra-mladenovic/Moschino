<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;

class Post{


    function getAllPosts(){
        return \DB::table("post AS p")
            ->join("user AS u","p.id_user", "=", "u.id_user")
            ->select("p.*","u.full_name")
            ->paginate(4);
    }

    public function getRecentPosts(){
        return \DB::table("post")
            ->select("*")
            ->orderBy("created_at","DESC")
            ->take(5)
            ->get();
    }

    public function getPopularPosts(){
        return \DB::table("post")
            ->select("*")
            ->orderBy("view","DESC")
            ->take(5)
            ->get();
    }
    public function getAllPostsFromOneCategory($id){
        return \DB::table("post AS p")
            ->join("user AS u","u.id_user","=","p.id_user")
            ->join("post_cat AS ps","ps.id_post","=","p.id_post")
            ->select("p.*","u.full_name")
            ->where([
                ['ps.id_category',"=",$id]
            ])
            ->paginate(4);
    }
    public function getPostCategories($id){
        return \DB::table("category AS c")
            ->join("post_cat AS ps","ps.id_category","=","c.id_category")
            ->select("c.*")
            ->where([
                ["ps.id_post","=",$id]
            ])
            ->get();
        // ->toArray();
    }
    public function getOnePostAllDetails($id){
        $postDetails= \DB::table("post AS p")
            ->join("user AS u","u.id_user","=","p.id_user")
            ->select("p.*","u.full_name","u.id_user")
            ->where([
                ["p.id_post", "=", $id]
            ])
            ->first();
        $postCat=$this->getPostCategories($id);
        $postDetails->postCategories=$postCat;
        return $postDetails;

    }
    public function addView($id){
        return \DB::table('post')
            ->where("id_post","=",$id)
            ->increment('view');
    }

    public function getAllPostsOfOneUser($id){
        return \DB::table('post AS p')
            ->join('user AS u',"u.id_user","=","p.id_user")
            ->where("p.id_user","=",$id)
            ->select("p.*","u.full_name")
            ->get();
    }

    public function allPosts(){
        return \DB::table('post')->get();
    }

    public function deletePost($id){
        $this->deletePostComments($id);
        $this->deletePostCategories($id);

        \DB::table('post')
            ->where('id_post',$id)
            ->delete();
    }

    public function deletePostComments($id){
        \DB::table('comment')
            ->where('id_post',$id)
            ->delete();
    }

    public function deletePostCategories($id){
        \DB::table('post_cat')
            ->where('id_post',$id)
            ->delete();
    }

    public function insertGetId(PostRequest $request,$name){
        return \DB::table('post')
            ->insertGetId([
                "title"=>$request->input('title'),
                "description"=>$request->input('description'),
                "content"=>$request->input('content'),
                "photo"=>$name,
                "id_user"=>session()->get('user')->id_user
            ]);
    }


    public function insertPostCat($categories,$id){
        $itemsToInsert = [];
        $values = [];
        foreach($categories as $idCat){
            $itemsToInsert[]=[
                "id_post"=>$id,
                "id_category"=>$idCat
            ];
        }
        \DB::table("post_cat")->insert(
            $itemsToInsert
        );

    }

    public function updatePost(UpdatePostRequest $request,$id,$name){
        if(!$name){
        return \DB::table('post')
                ->where('id_post',$id)
                ->update([
                    "title"=>$request->input('title'),
                    "description"=>$request->input('description'),
                    "content"=>$request->input('content'),
                    "updated_at"=>now()
                ]);
        }else{
            return \DB::table('post')
                ->where('id_post',$id)
                ->update([
                    "title"=>$request->input('title'),
                    "description"=>$request->input('description'),
                    "content"=>$request->input('content'),
                    "photo"=>$name,
                    "updated_at"=>now()
                ]);
        }
    }

    public function deletePostCatWhileUpdating(UpdatePostRequest $request,$id){

        $delete = \DB::table('post_cat')
                ->where('id_post',$id)
                ->delete();

         $this->insertPostCat($request->input('categories'), $id);
    }

    public function getSearchPosts($search){
        return \DB::table("post AS p")
            ->join("user AS u","p.id_user", "=", "u.id_user")
            ->select("p.*","u.full_name")
            ->where('title','LIKE',$search)
            ->orWhere('description', 'LIKE',$search)
            ->paginate(4);

    }
}
