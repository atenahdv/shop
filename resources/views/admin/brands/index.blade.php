@extends('admin.layout.master')

@section('content')

    <section class="content">
    <div class="card">
        <div class="card-header border-transparent col-md-12">

            <div class="box-tools pull-left">
            <a class="btn btn-app" href="{{route('brands.create')}}">
                <i class="fa fa-plus"></i>  جدید
            </a>
            </div>
        </div>

        <div class="card-body p-0 col-md-12">
            @include('admin.partials.form-errors')
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <h3 class="card-title"> برند ها </h3>
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
                    @foreach($brands as $brand)
                    <tr>
                        <td class="text-center">{{$brand->id}}</td>
                        <td class="text-center">{{$brand->title}}</td>
                        <td class="text-center">
                            <a href="{{route('brands.edit',$brand->id)}}" class="btn btn-warning">ویرایش</a>
                            <a href="{{route('brands.destroy', $brand->id)}}" class="btn btn-danger" onclick="return confirm('آیا از حذف برند مطمعئن هستید؟')">حذف</a>
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
