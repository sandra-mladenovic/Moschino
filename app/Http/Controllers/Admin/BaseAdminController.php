<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class BaseAdminController extends Controller
{
    protected $data = [];

    public function __construct(){
        $model=new Contact();
        $newMessages=$model->numberOfNewMessages();
        $this->data['numOfmes']=$newMessages;
        $this->data['navigation'] = [
            0 => [
                "title" => "Dashboard",
                "href" => "/admin",
                "icon"=>"dashboard"
            ],
            1 => [
                "title" => "Posts",
                "href" => "/admin/posts",
                "icon"=>"library_books"
            ],
            2 => [
                "title" => "Users",
                "href" => "/admin/users",
                "icon"=>"person"
            ],
            3 => [
                "title" => "Comments",
                "href" => "/admin/comments",
                "icon"=>"comment"
            ],
            4 => [
                "title" => "Category",
                "href" => "/admin/category",
                "icon"=>"content_paste"
            ],
            5 => [
                "title" => "Back Home",
                "href" => "/",
                "icon"=>"exit_to_app"
            ]
        ];
//        dd($this->data['navigation']);
    }
}
