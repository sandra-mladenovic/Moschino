<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Session;

class UserController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=new User();
        $users=$model->allUsers();
        return view("pages.admin.users",["users"=>$users],$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.admin.user_form",$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        try{
        $model=new UserService();
        $model->inserNewUser($request);
        session()->flash('alert-success', 'User added successfully');
        return redirect(route('users.index'));
        }catch(\Exception $ex){
            \Log::error("There was an error while adding new user: " . $ex->getMessage());
            session()->flash('alert-danger', 'Error contact administrator');
            return redirect(route('users.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=new User();
        $user=$model->getUserById($id);
        return view('pages.admin.user_form',["user"=>$user],$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try{
            $model=new UserService();
            $model->updateUser($request,$id);
            session()->flash('alert-success', 'User updated successfully');
            return redirect(route('users.index'));
            }catch(\Exception $ex){
                \Log::error("There was an error while updating user: " . $ex->getMessage());
                session()->flash('alert-danger', 'Error contact administrator');
                return redirect(route('users.index'));
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $model=new UserService();
            $model->deleteUser($id);
            session()->flash('alert-success', 'User deleted successfully');
            return redirect(route('users.index'));
            }catch(\Exception $ex){
                \Log::error("There was an error while deleting user: " . $ex->getMessage());
                session()->flash('alert-danger', 'Error contact administrator');
                return redirect(route('users.index'));
            }
    }

    public function usersActivities(){
       // dd('sdasdasdasdasda');
            $model=new User();
            $activities=$model->usersActivities();
            return view('pages.admin.activities',['activities'=>$activities],$this->data);
    }

    public function usersActivitiesFilterd(Request $request){
        $model=new User();
        $activities=$model->usersActivitiesFilterd($request->date);
        return response($activities,200);
    }
}
