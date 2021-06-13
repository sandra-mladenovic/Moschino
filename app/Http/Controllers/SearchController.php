<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends FrontendController
{
    public function searchPost(Request $request){

        try {
            $model = new Post();
            if($request->ajax()){
                $posts = $model->getSearchPosts("%".strtolower($request->search)."%");
                return response()->json([
                    'status' => 'search',
                    'posts' => $posts,
                    'pagination' => $posts->links()->render()
                ]);
            }else{
                $posts = $model->getSearchPosts("%".strtolower($request->query('query'))."%");
                return view("pages.results",["posts"=>$posts],$this->data);
            }
        }catch(\Exception $ex){
            \Log::error("There was an error : " . $e->getMessage());
            session()->flash('alert-danger', 'Error while searching a post contact administartor');
            return redirect()->back();
        }
    }
}
