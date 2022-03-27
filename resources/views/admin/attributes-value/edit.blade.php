@extends('admin.layout.master')

@section('content')
<section class="content">
    <div class="card">
        <div class="card-header border-transparent col-md-12">

            <h3 class="card-title">ویرایش مقدار ویژگی
                {{$attributeValue->title}}
            </h3>

        </div>

        <div class="box-body ">

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="/administrator/attributes-value/{{$attributeValue->id}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <label for="title">عنوان :  </label>
                        <div class="form-group">
                            <input name="title" id="title" type="text" class="form-control" value="{{$attributeValue->title}}" placeholder="عنوان دسته بندی">
                        </div>

                        <label for="type"> نوع  : </label>
                        <div class="form-group">
                            <select class="form-control" name="attributegroup_id" id="attributegroup_id">
                                <option value=""> انتخاب کنید... </option>
                                @foreach($attributesGroup as $attribute)
                                    <option value="{{$attribute->id}}" @if($attribute->id==$attributeValue->attributeGroup->id) selected @endif> {{$attribute->title}}</option>
                                @endforeach
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
