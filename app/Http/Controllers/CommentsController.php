<?php


namespace App\Http\Controllers;


use App\Models\Base;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends FrontendController
{
    public function addComment(Request $request){
        $model=new Comment();
        try{
            $model->addComment($request);
            $base=new Base();
            $base->logAction($request->id_user,"Comment Post");
            return response(null,201);
        }catch(\Exception $ex ){
            // \Log::error($ex->getMessage());
            return response(null,500);

        }

    }

    public function getAllComments($id){
        $model=new Comment();
        $data=$model->getPostComments($id);
        return response($data);
    }
}
