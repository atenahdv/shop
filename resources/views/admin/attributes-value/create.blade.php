@extends('admin.layout.master')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header border-transparent col-md-12">

                <h3 class="card-title">ایجاد مفدار ویژگی جدید</h3>
            </div>

            <div class="box-body ">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <form action="/administrator/attributes-value" method="post">
@csrf
                    <label for="attributegroup_id"> انتخاب ویژگی :  </label>
                    <div class="form-group">

                        <select class="form-control" name="attributegroup_id" id="attributegroup_id">
                            <option value=""> انتخاب کنید... </option>
                            @foreach($attributesGroup as $attribute)
                                <option value="{{$attribute->id}}"> {{$attribute->title}}</option>
                            @endforeach
                        </select>
                    </div>

          <label for="title">عنوان :  </label>
           <div class="form-group">
               <input name="title" id="title" type="text" class="form-control" placeholder="مقدار ویژگی ">
               </div>
    <button type="submit" class=" pull-left btn btn-success">ذخیره</button>

                </form>

                    </div>
            </div>
            </div>



        </div>
    </section>
@endsection
