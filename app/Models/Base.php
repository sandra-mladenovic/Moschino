<?php

namespace App\Models;
class Base{
    public function logAction($user,$action){
        return \DB::table('action')
            ->insert([
                'id_user'=>$user,
                'action'=>$action
            ]);
    }
}
