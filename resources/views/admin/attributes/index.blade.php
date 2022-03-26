@extends('admin.layout.master')

@section('content')

    <section class="content">
    <div class="card">
        <div class="card-header border-transparent col-md-12">

            <div class="box-tools pull-left">
            <a class="btn btn-app" href="{{route('attributes-group.create')}}">
                <i class="fa fa-plus"></i>  جدید
            </a>
            </div>
        </div>

        <div class="card-body p-0 col-md-12">
            @if(Session::has('attributes'))
                <div class="alert alert-success">
                    {{session('attributes')}}
                </div>
            @endif
                @if(Session::has('attribute_delete'))
                    <div class="alert alert-danger">
                        {{session('attribute_delete')}}
                    </div>
                @endif
            <h3 class="card-title">ویژگی ها</h3>
            <div class="table-responsive rtl">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th class="text-center">شناسه</th>
                        <th class="text-center">عنوان</th>
                        <th class="text-center">نوع</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributesGroup as $attribute)
                    <tr>
                        <td class="text-center">{{$attribute->id}}</td>
                        <td class="text-center">{{$attribute->title}}</td>
                        <td class="text-center">{{$attribute->type}}</td>
                        <td class="text-center">
                            <a href="{{route('attributes-group.edit',$attribute->id)}}" class="btn btn-warning">ویرایش</a>
                            <a href="{{route('attributes-group.destroy', $attribute->id)}}" class="btn btn-danger" onclick="return confirm('آیا از حذف ویژگی  مطمعئن هستید؟')">حذف</a>
                        </td>

                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
    </section>
@endsection
