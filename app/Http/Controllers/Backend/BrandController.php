<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::paginate(10);
        return view('admin.brands.index',compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
           'title' => 'required|unique:brands',
           'description' => 'required',
           'photo_id' => 'required',
        ],[
            'title.required' => 'عنوان برند شما باید درج شود.',
            'title.unique' => 'عنوان برند شما باید منحصر به فرد باشد.',
            'description.required' => 'توضیحات برند شما باید  درج  شود.',
            'photo_id.required' => 'تصویر برند شما باید  اپلود  شود.',

        ]);
        if($validator->fails()){
            return redirect('/administrator/brands/create')->withErrors($validator)->withInput();
        }else{
            $brands= new Brand();
            $brands->title = $request->input('title');
            $brands->description = $request->input('description');
            $brands->photo_id = $request->input('photo_id');
            $brands->save();
            Session::flash('success','برند با موفقیت ذخیره شد');
            return redirect('/administrator/brands');
            return view('admin.brands.index');



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
        $brand=Brand::with('photo')->whereId($id)->first();
        return view('admin.brands.edit',compact(['brand']));
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
        $validator=Validator::make($request->all(),[
            'title' => 'required|unique:brands,title,'.$id,
            'description' => 'required',
        ],[
            'title.required' => 'عنوان برند شما باید درج شود.',
            'title.unique' => 'عنوان برند شما باید منحصر به فرد باشد.',
            'description.required' => 'توضیحات برند شما باید  درج  شود.',

        ]);
        if($validator->fails()){
            return redirect('/administrator/brands')->withErrors($validator)->withInput();
        }else{
            $brands= Brand::findorfail($id);
            $brands->title = $request->input('title');
            $brands->description = $request->input('description');
            $brands->photo_id = $request->input('photo_id');
            $brands->save();
            Session::flash('success','برند با موفقیت ویرایش شد');
            return redirect('/administrator/brands');
            return view('admin.brands.index');



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
        $brand=Brand::findorfail($id);
        Session::flash('success','برند ' . $brand->title .' با موفقیت حذف شد');
        $brand->delete();
        return redirect('/administrator/brands');
    }
}
