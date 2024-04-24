<?php

namespace App\Http\Controllers\Api;

use App\Models\CategoryDescription;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['descriptions'])->get();
        return response()->json($categories->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Gate::allows("is_in_role",1)){
            $data=request()->input();
           $cat=new Category();
           $cat->save();
           $cat->refresh();
          
           foreach($data["descriptions"] as $key=>$value){
              $value["categoryId"]=$cat[0]["id"];
              $desc=new CategoryDescription($value->toArray());
              $desc->save();
              
              
           }
           $category = Category::with(['descriptions'])->where(['id'=>$cat[0]['id']])->first();
           return response()->json($category->toArray());


          }
          elseif(Gate::allows("is_in_role",2)){
            return response()->json(['error' => 'Forbidden'], 403);
          }
          else{
            return response()->json(['error' => 'Unauthorized'], 401);
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
