@extends('admin.layout.master')

@section('content')

    <section class="content">
    <div class="card">
        <div class="card-header border-transparent col-md-12">

            <div class="box-tools pull-left">
            <a class="btn btn-app" href="{{route('categories.create')}}">
                <i class="fa fa-plus"></i>  جدید
            </a>
            </div>
        </div>

        <div class="card-body p-0 col-md-12">
            @if(Session::has('error_category'))
                <div class="alert alert-danger">
                    {{session('error_category')}}
                </div>
            @endif
            <h3 class="card-title">دسته بندی ها </h3>
            <div class="table-responsive rtl">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th class="text-center">شناسه</th>
                        <th class="text-center">عنوان</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="text-center">{{$category->id}}</td>
                        <td class="text-center">{{$category->name}}</td>
                        <td class="text-center">
                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning">ویرایش</a>
                            <a href="{{route('categories.destroy', $category->id)}}" class="btn btn-danger" onclick="return confirm('آیا از حذف دسته بندی مطمعئن هستید؟')">حذف</a>

                            <a href="{{route('categories.indexSetting',$category->id)}}" class="btn btn-primary">تنظیمات</a>
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
