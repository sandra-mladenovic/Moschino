<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends BaseAdminController
{
    public function index(){
        $model=new Contact();
        $messages=$model->getMessages();
        return view("pages.admin.messages",['messages'=>$messages],$this->data);
    }

    public function view($id){
        $model=new Contact();
        $message=$model->getOneMessage($id);
        return view("pages.admin.one_message",['message'=>$message],$this->data);
    }

    public function delete($id){
        $model=new Contact();
        $model->deleteMess($id);
        return response(null,204);
    }

    public function allMessages(){
        $model=new Contact();
        $messages=$model->getMessages();
        return response($messages,200);
    }
}
