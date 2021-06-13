<?php

namespace App\Models;
use Illuminate\Http\Request;
//use Illuminate\Http\CommentRequest;

class Comment{
    public function addComment(Request $request){
        return \DB::table("comment")
            ->insert([
                "id_user"=>$request->id_user,
                "id_post"=>$request->post_id,
                "comment"=>$request->comment
            ]);
    }
    public function getPostComments($id){
        return \DB::table('comment AS c')
            ->join('user AS u',"c.id_user","=","u.id_user")
            ->select("c.*","u.full_name")
            ->where([
                ["c.id_post","=",$id]
            ])
            ->orderBy("c.date","ASC")
            ->get();
    }

    public function allComments(){
        return \DB::table('comment AS c')
            ->join('user AS u','c.id_user','=','u.id_user')
            ->join('post AS p','c.id_post','=','p.id_post')
            ->select('c.*','u.full_name','p.title')
            ->get();
    }

    public function deleteCom($id){
        return \DB::table('comment')
            ->where('id_comment',$id)
            ->delete();
    }

    // public function numberOfComments($id){
    //     return \DB::table('comment AS c')
    //     ->join('user AS u',"c.id_user","=","u.id_user")
    //     ->select("c.*","u.full_name")
    //     ->where([
    //         ["c.id_post","=",$id]
    //     ])
    //     ->count();
    // }
}
