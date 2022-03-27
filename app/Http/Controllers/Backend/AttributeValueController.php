<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesValue=AttributeValue::with('attributeGroup')->paginate(10);
        return view('admin.attributes-value.index',compact(['attributesValue']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributesGroup=AttributeGroup::all();
        return view('admin.attributes-value.create',compact(['attributesGroup']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $newValue=new AttributeValue();
       $newValue->title=$request->input('title');
       $newValue->attributegroup_id=$request->input('attributegroup_id');
       $newValue->save();
        Session::flash('attributes','مقدار ویژگی جدید با موفقیت اضافه شد');
        return redirect('/administrator/attributes-value');
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
        $attributeValue=AttributeValue::with('attributeGroup')->whereId($id)->first();
        $attributesGroup=AttributeGroup::all();
        return view('admin.attributes-value.edit',compact(['attributeValue','attributesGroup']));
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
        $attributValue=AttributeValue::findorfail($id);
        $attributValue->title=$request->input('title');
        $attributValue->attributegroup_id=$request->input('attributegroup_id');
        $attributValue->save();
        Session::flash('attributes','مقدار ویژگی  با موفقیت ویرایش شد');
        return redirect('/administrator/attributes-value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute=AttributeValue::findorfail($id);
        $attribute->delete();
        Session::flash('attribute_delete','مقدار ویژگی حذف شد');
        return redirect('/administrator/attributes-value');
    }
}
