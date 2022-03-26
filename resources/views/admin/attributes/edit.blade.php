@extends('admin.layout.master')

@section('content')
<section class="content">
    <div class="card">
        <div class="card-header border-transparent col-md-12">

            <h3 class="card-title">ویرایش گروه ویژگی
                {{$attributeGroup->title}}
            </h3>

        </div>

        <div class="box-body ">

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="/administrator/attributes-group/{{$attributeGroup->id}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <label for="name">عنوان :  </label>
                        <div class="form-group">
                            <input name="title" id="title" type="text" class="form-control" value="{{$attributeGroup->title}}" placeholder="عنوان دسته بندی">
                        </div>

                        <label for="type"> نوع  : </label>
                        <div class="form-group">
                            <select name="type" id="type" class="form-control">
                                <option value="select" @if($attributeGroup->type == 'select') selected @endif>لیست تکی</option>
                                <option value="multiple" @if($attributeGroup->type == 'multiple') selected @endif>لیست چندتایی</option>
                            </select>
                        </div>

                        <button type="submit" class=" pull-left btn btn-success">ویرایش</button>

                    </form>

                </div>
            </div>
        </div>



    </div>
</section>
@endsection
