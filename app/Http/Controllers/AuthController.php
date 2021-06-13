<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
//use App\Http\Requests\ForgotPasswordRequest;
//use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;
use App\Models\Base;
use Reminder;
use Sentinel;

class AuthController extends FrontendController
{
    public function login(){
        return view("pages.login",$this->data);
    }

    public function doLogin(LoginRequest $request){
        try{
            $model=new User();
            $user=$model->getUserByEmailPassword($request->input('email'),$request->input('password'));
            if($user){
                $model->setActive($user->id_user);
                $request->session()->put("user",$user);
                $base=new Base();
                $base->logAction($user->id_user,"Log in");
                return redirect('/home');
            }else{
                session()->flash('alert-danger','User not found');
                return redirect('/login');
            }
        }catch(\Exception $e){
//            \Log::error("There was an error : " . $e->getMessage());
            session()->flash('alert-danger', 'Error while logging');
            return redirect('/login');
        }

    }

    public function logout(Request $request){
        try{
            $user=session()->get('user');
            $model=new User();
            $base=new Base();
            $base->logAction($user->id_user,"Log out");
            $model->unsetActive($user->id_user);
            $request->session()->forget("user");
            $request->session()->flush();
            return \redirect("/login");
        }catch(\Exception $e){
            \Log::error("There was an error logginout: " . $e->getMessage());
            return \redirect('/login');
        }
    }

    public function register(){
        return view("pages.register",$this->data);
    }

    public function doRegister(RegisterRequest $request){
      /// dd($request->name);
        try{
            $model=new User();
            $reg=$model->insertNewUser($request);
            $base=new Base();
            $base->logAction($reg,"Registration");
            if($reg){
                $user=$model->getUserByEmailPassword($request->input("email"),$request->input("password"));
                if($user){
                    $request->session()->put('user',$user);
                    $base->logAction($user->id_user,"Log in");
                    return \redirect("/home");
                }
            }
        }catch(\Exception $e){
            \Log::error("There was an error : " . $e->getMessage());
            session()->flash('alert-danger', 'Error while registrating');
            return \redirect('/login');
        }

    }
}
