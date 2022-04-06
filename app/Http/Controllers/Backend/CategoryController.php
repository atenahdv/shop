<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::paginate(10);
        return view('admin.categories.index',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        return view('admin.categories.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category=new Category();
        $category->name=$request->input('name');
        $category->parent_id=$request->input('parent_id');
        $category->meta_title=$request->input('meta_title');
        $category->meta_desc=$request->input('meta_desc');
        $category->meta_keywords=$request->input('meta_keywords');
        $category->save();

        return redirect('/administrator/categories');
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
        $categories=Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $category=Category::findorfail($id);
        return view('admin.categories.edit',compact(['categories','category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category=Category::findorfail($id);
        $category->name=$request->input('name');
        $category->parent_id=$request->input('parent_id');
        $category->meta_title=$request->input('meta_title');
        $category->meta_desc=$request->input('meta_desc');
        $category->meta_keywords=$request->input('meta_keywords');
        $category->save();

        return redirect('/administrator/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::with('childrenRecursive')->where('id',$id)->first();
        if(count($category->childrenRecursive)>0){
            Session::flash('error_category','این دسته بندی حاوی زیرمجموعه میباشد و حذف ان امکان پذیر نمیباشد.');
            return redirect('/administrator/categories');
        }
        $category->delete();
        return redirect('/administrator/categories');
    }

    public function indexSetting($id)
    {
        $category=Category::findorfail($id);
        $attributeGroups=AttributeGroup::all();
        return view('admin.categories.index-setting',compact(['category','attributeGroups']));
    }

    public function saveSetting(Request $request,$id)
    {

        $category=Category::findorfail($id);
        $category->AttributeGroups()->sync($request->attributeGroups);
        $category->save();
        return redirect()->to('/administrator/categories');

    }

    public function apiIndex()
    {
        $empData['data']=Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();

        return response()->json($empData);
    }

    public function apiIndexAttribute(Request $request)
    {
      $categories=$request->categories_id;
      $attributeGroup['data']=AttributeGroup::with('attributesValue','categories')
          ->whereHas('categories', function ($q) use ($categories) {
              $q->whereIN('categories.id',$categories);
          })->get();
        return response()->json($attributeGroup);
    }
}
