<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Category Page
    public function categoryPage(){
        $Key = request('SearchKey');

        $categories = Category::when($Key,function($category){

            $Key = request('SearchKey');
            $category->where('title','like','%' .$Key. '%');

        })->orderBy('created_at','desc')->paginate(7);

        $categories->appends(request()->query());

        return view('Admin.category.categoryPage',compact('categories'));
    }

    //Create Category
    public function createCategory(Request $request){
        $this->createCategoryValidation($request);
        $data = $this->create_updateCategoryData($request);
        Category::create($data);
        return back();
    }

     // Delete Category
     public function deleteCategory($CategoryId){
        Category::where('id',$CategoryId)->delete();
        return back();
    }

    // Update Category Page
    public function updateCategoryPage($CategoryId){
        $categoryTitle = Category::where('id',$CategoryId)->first();
        return view('Admin.category.categoryUpdatePage',compact('categoryTitle'));
    }

    // Update Category
    public function updateCategory(Request $request){
        $this->updateCategoryValidation($request);
        $data = $this->create_updateCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#categoryPage');
    }

    //Create Category Validation
    private function createCategoryValidation($request){
        Validator::make($request->all(),[
            'categoryTitle' => 'required|unique:categories,title'
        ])->validate();
    }

    // Create && Update Category Data
    private function create_updateCategoryData($request){
        return[
            'title' => $request->categoryTitle
        ];
    }

    // updateCategoryValidation
    private function updateCategoryValidation($request){
        Validator::make($request->all(),[
            'categoryTitle' => 'required|unique:categories,title,' . $request->categoryId
        ])->validate();
    }
}
