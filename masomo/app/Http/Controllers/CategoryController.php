<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    } 
    
    public function index(){
        $categories = Category::all();
        return view("categories.index", compact('categories'));
    }
    
   public function create(){
       return view("categories.create");
   }
   
   public function store(Request $Requests){
       $category = new Category();
       $category->cat_name = $Requests->input('cat_name');
       $category->save();
        return redirect("/home");
   }
}
