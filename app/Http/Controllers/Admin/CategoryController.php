<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=new Category();
        $categories=$model->getAllCategories();
        return view('pages.admin.categories',['categories'=>$categories],$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category_form',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try{
            $model=new Category();
            $model->inserNewCat($request);
            session()->flash('alert-success', 'Category added successfully');
            return redirect(route('category.index'));
            }catch(\Exception $ex){
                \Log::error("There was an error while adding new category: " . $ex->getMessage());
                session()->flash('alert-danger', 'Error contact administrator');
                return redirect(route('category.index'));
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
        $model=new Category();
        $category=$model->findeCat($id);
        return view('pages.admin.category_form',['category'=>$category],$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try{
            $model=new Category();
            $model->updateCat($request,$id);
            session()->flash('alert-success', 'Category updated successfully');
            return redirect(route('category.index'));
            }catch(\Exception $ex){
                \Log::error("There was an error while updating category: " . $ex->getMessage());
                session()->flash('alert-danger', 'Error contact administrator');
                return redirect(route('category.index'));
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
            $model=new Category();
            $flag=$model->deleteCat($id);
            if($flag){
            session()->flash('alert-success', 'Category deleted successfully');
            }else{
                session()->flash('alert-danger', 'Category that contains posts can not be deleted');
            }
            return redirect(route('category.index'));
            }catch(\Exception $ex){
                \Log::error("There was an error while deleting category: " . $ex->getMessage());
                session()->flash('alert-danger', 'Error contact administrator');
                return redirect(route('category.index'));
            }
    }
}
