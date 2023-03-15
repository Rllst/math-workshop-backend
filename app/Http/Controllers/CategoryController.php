<?php

namespace App\Http\Controllers;

use App\Domain\Mapper;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request){
        $category = Mapper::JsonToCategory($request->getContent());
        $category->save();
        return $category->id;
    }
    public function readAll(){
        return Category::all();
    }
    public function read($id){
        return Category::find($id);
    }
    public function update(Request $request, $id){
        $updated = Mapper::JsonToCategory($request->getContent());
        Category::find($id)->update($updated->toArray());
        return true;
    }
    public function delete($id){
        Category::find($id)->delete();
    }

}
