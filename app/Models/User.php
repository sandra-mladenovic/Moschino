<?php
namespace App\Models;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class User{

    public function getUserByEmailPassword($email,$password){
        return \DB::table("user AS u")
            ->join("role AS r","u.id_role","=","r.id_role")
            ->select("u.*","r.role")
            ->where([
                ["email","=",$email],
                ["password","=",md5($password)]
            ])
            ->first();

    }

    public function insertNewUser(RegisterRequest $request){
        return \DB::table("user")
            ->insertGetId([
                "email"=>$request->input("email"),
                "password"=>md5($request->input("password")),
                "full_name"=>$request->input("name")
            ]);
    }


    public function setActive($id){
        return \DB::table('user')
            ->where("id_user","=",$id)
            ->update([
                "active"=>"1"
            ]);

    }

    public function unsetActive($id){
        return \DB::table('user')
            ->where("id_user","=",$id)
            ->update([
                "active"=>"0"
            ]);
    }

    public function allUsers(){
        return \DB::table('user AS u')
            ->join('role AS r','u.id_role','=','r.id_role')
            ->select('u.*','r.role')->get();
    }

    public function getUserById($id){
        return \DB::table('user AS u')
            ->join('role AS r','u.id_role','=','r.id_role')
            ->select('u.*','r.role')
            ->where('id_user',$id)
            ->first();
    }

    public function updateUser(UpdateUserRequest $request,$id){
        if($request->input('password')){
            $this->updateUserWithPass($request,$id);
        }else {
            $this->updateUserNoPass($request,$id);
        }
    }

    public function updateUserWithPass(UpdateUserRequest $request,$id){
        return \DB::table('user')
            ->where('id_user',$id)
            ->update([
                "full_name"=>$request->input('name'),
                "email"=>$request->input('email'),
                "password"=>md5($request->input('password'))
            ]);
    }

    public function updateUserNoPass(UpdateUserRequest $request,$id){
        return \DB::table('user')
            ->where('id_user',$id)
            ->update([
                "full_name"=>$request->input('name'),
                "email"=>$request->input('email')
            ]);
    }

    public function deleteUser($id){
        $this->deleteUserComments($id);
        $this->deleteUserPosts($id);
        \DB::table('user')
            ->where('id_user',$id)
            ->delete();
    }

    public function deleteUserPosts($id){
        \DB::table('post')
            ->where('id_user',$id)
            ->delete();
    }

    public function deleteUserComments($id){
        \DB::table('comment')
            ->where('id_user',$id)
            ->delete();
    }



    public function usersActivitiesFilterd($date){
        if($date){
            return \DB::table('action AS a')
                ->join('user AS u','a.id_user','=','u.id_user')
                ->select('a.*','u.full_name')
                ->whereDate('date','=',$date)
                ->get();
        } else {
            return $this->usersActivities();
        }
    }

    public function usersActivities(){
        return \DB::table('action AS a')
            ->join('user AS u','a.id_user','=','u.id_user')
            ->select('a.*','u.full_name')
            ->orderBy('date','DESC')
            ->get();
    }


}
