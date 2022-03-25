@extends('admin.layout.master')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header border-transparent col-md-12">

                <h3 class="card-title">ایجاد دسته بندی جدید</h3>
            </div>

            <div class="box-body ">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <form action="/administrator/categories" method="post">
@csrf
          <label for="name">عنوان :  </label>
           <div class="form-group">
               <input name="name" id="name" type="text" class="form-control" placeholder="عنوان دسته بندی">
               </div>

                    <label for="name"> گروه  : </label>
                    <div class="form-group">
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value=""> گروه اصلی</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @if(count($category->childrenRecursive))
                                    @include('admin.partials.category',['categories'=>$category->childrenRecursive,'level'=>1])
                                @endif
                                @endforeach
                        </select>
                    </div>

                    <label for="meta_title">عنوان سئو:  </label>
                    <div class="form-group">
                        <input name="meta_title" id="meta_title" type="text" class="form-control" placeholder="عنوان سئو">
                    </div>

                    <label for="meta_desc">توضیحات سئو:  </label>
                    <div class="form-group">
                        <textarea name="meta_desc" id="meta_desc" type="text" class="form-control" placeholder="توضیحات سئو"></textarea>

                    </div>

                    <label for="meta_keywords">کلمات کلیدی سئو:  </label>
                    <div class="form-group">
                        <input name="meta_keywords" id="meta_keywords" type="text" class="form-control" placeholder="کلمات کلیدی سئو">
                    </div>

    <button type="submit" class=" pull-left btn btn-success">ذخیره</button>

                </form>

                    </div>
            </div>
            </div>



        </div>
    </section>
@endsection
