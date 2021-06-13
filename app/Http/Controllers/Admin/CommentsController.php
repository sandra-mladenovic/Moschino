<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;


class CommentsController extends BaseAdminController{
    public function index(){
        $model=new Comment();
        $comments=$model->allComments();
        return view('pages.admin.comments',['comments'=>$comments],$this->data);
    }

    public function delete($id){
        $model=new Comment();
        $model->deleteCom($id);
        return response(null,204);
    }

    public function allComments(){
        $model=new Comment();
        $data=$model->allComments();
        return response($data,200);
    }
}