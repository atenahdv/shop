@extends('admin.layout.master')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header border-transparent col-md-12">

                <h3 class="card-title">تعیین ویژگی دسته بندی {{$category->name}}</h3>
            </div>

            <div class="box-body ">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <form action="/administrator/categories/{{$category->id}}/settings" method="post">
@csrf


                    <label for="attributeGroups"> ویژگی ها  : </label>
                    <div class="form-group">
                        <select name="attributeGroups[]" id="attributeGroups" class="form-control" multiple>

                            @foreach($attributeGroups as $attributeGroup)
                                <option value="{{$attributeGroup->id}}" @if(in_array($attributeGroup->id,$category->attributeGroups->pluck('id')->toArray())) selected  @endif>{{$attributeGroup->title}}</option>
                                @endforeach
                        </select>
                    </div>

    <button type="submit" class=" pull-left btn btn-success">ذخیره</button>

                </form>

                    </div>
            </div>
            </div>



        </div>
    </section>
@endsection
