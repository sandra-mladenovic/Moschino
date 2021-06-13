<?php

namespace App\Models;
use App\Http\Requests\CategoryRequest;

class Category
{
    public function getAllCategories(){
        return \DB::table('category')->get();
    }

    public function inserNewCat(CategoryRequest $request){
        return \DB::table('category')
            ->insert([
                "category"=>$request->input('category_name')
            ]);
    }
    public function findeCat($id){
        return \DB::table('category')
            ->select('*')
            ->where('id_category',$id)
            ->first();
    }
    public function updateCat(CategoryRequest $request,$id){
        return \DB::table('category')
            ->where('id_category',$id)
            ->update([
                "category"=>$request->input('category_name'),
                "updated_at"=>now()
            ]);
    }

    public function deleteCat($id){
        $posts=$this->findePostWitCat($id);
        if(count($posts)){
            return false;
        }else{
            \DB::table('category')
                ->where('id_category',$id)
                ->delete();
            return true;
        }
    }

    public function findePostWitCat($id){
        return \DB::table('post_cat')
            ->select('id_post')
            ->where('id_category',$id)
            ->get();
    }
    public function getCatName($id){
        return \DB::table('category')
            ->select('category')
            ->where('id_category',$id)
            ->first();
    }
}

