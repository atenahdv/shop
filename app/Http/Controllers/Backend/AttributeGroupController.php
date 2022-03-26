<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Sodium\compare;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesGroup=AttributeGroup::paginate(10);
        return view('admin.attributes.index',compact(['attributesGroup']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributeGroup=new AttributeGroup();
        $attributeGroup->title=$request->input('title');
        $attributeGroup->type=$request->input('type');
        $attributeGroup->save();
        Session::flash('attributes','ویژگی جدید با موفقیت اضافه شد');
        return redirect('/administrator/attributes-group');
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
        $attributeGroup=AttributeGroup::findorfail($id);
        return view('admin.attributes.edit',compact(['attributeGroup']));
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
        $attributeGroup=AttributeGroup::findorfail($id);
        $attributeGroup->title=$request->input('title');
        $attributeGroup->type=$request->input('type');
        $attributeGroup->save();
        Session::flash('attributes','ویژگی  با موفقیت ویرایش شد');
        return redirect('/administrator/attributes-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute=AttributeGroup::findorfail($id);
        $attribute->delete();
        Session::flash('attribute_delete','ویژگی حذف شد');
        return redirect('/administrator/attributes-group');
    }
}
