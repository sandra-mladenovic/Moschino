<?php
namespace App\Models;
use App\Http\Requests\ContactRequest;


class Contact{

    public function sendMewssage(ContactRequest $request){
        return \DB::table('message')
            ->insert([
                'email'=>$request->input('email'),
                'subject'=>$request->input('subject'),
                'message'=>$request->input('message')
            ]);
    }

    public function getMessages(){
        return \DB::table('message')->orderBy('date', 'DESC')->get();
    }


    public function numberOfNewMessages(){
        return \DB::table('message')
            ->where('mark_as_read','0')
            ->count();
    }

    public function getOneMessage($id){
        $this->markAsRead($id);
        return \DB::table('message')
            ->where('id_message',$id)
            ->select('*')
            ->first();

    }

    public function markAsRead($id){
        \DB::table('message')
            ->where('id_message',$id)
            ->update([
                'mark_as_read'=>'1'
            ]);
    }

    public function deleteMess($id){
        \DB::table('message')
            ->where('id_message',$id)
            ->delete();
    }


}
