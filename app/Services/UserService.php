<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserService{
    public function inserNewUser(RegisterRequest $request){
        // $name=$request->input("name");
        // $password=$request->input("password");
        // $email=$request->input("email");
        $model=new User();
        $add=$model->insertNewUser($request);
    }

    public function updateUser(UpdateUserRequest $request,$id){
        $model=new User();
        $model->updateUser($request,$id);
    }

    public function deleteUser($id){
        $postModel=new User();
        $postModel->deleteUser($id);
    }
}
