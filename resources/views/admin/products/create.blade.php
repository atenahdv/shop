@extends('admin.layout.master')
@section('styles')
<link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection

@section('content')

    <section class="content">
        <div class="card">
            <div class="card-header border-transparent col-md-12">

                <h3 class="card-title">ایجاد محصول جدید</h3>
            </div>

            <div class="box-body ">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <form action="/administrator/products" method="post" >
@csrf
          <label for="title">عنوان :  </label>
           <div class="form-group">
               <input name="title" id="title" type="text" class="form-control" placeholder="عنوان  محصول">
               @error('title')
               <div class="text-danger">{{ $message }}</div>
               @enderror
               </div>

                    <label for="title">نام مستعار :  </label>
                    <div class="form-group">
                        <input name="slug" id="slug" type="text" class="form-control" placeholder="نام مستعار">
                        @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="status"> وضعیت نشر:  </label>
                    <div class="form-group">
                        <input type="radio" name="status" id="status0" value="0" checked><span>غیرفعال</span>
                        <input type="radio" name="status" id="status1" value="1" ><span>فعال</span>
                    </div>
                    <label for="category_id"> دسته بندی  : </label>
                    <div class="form-group">
                        <select name="category_id[]" id="category_id" class="form-control" multiple>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @if(count($category->childrenRecursive))
                                    @include('admin.partials.category',['categories'=>$category->childrenRecursive,'level'=>1])
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <label for="brand_id"> برند : </label>
                    <div class="form-group">
                        <select name="brand_id" id="brand_id" class="form-control" >
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="price">قیمت  :  </label>
                    <div class="form-group">
                        <input name="price" id="price" type="number" class="form-control" placeholder="قیمت محصول ">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="discount_price">قیمت ویژه :  </label>
                    <div class="form-group">
                        <input name="discount_price" id="discount_price" type="number" class="form-control" placeholder="قیمت ویژه ">

                    </div>

                    <label for="meta_desc">توضیحات برند:  </label>
                    <div class="form-group">
                        <textarea name="description" id="description" type="text" class="form-control" placeholder="توضیحات برند"></textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label for="photo">تصویر :  </label>
                    <input type="hidden" name="photo_id" id="photo_id">
                    <div class="form-group">
                    <div id="photo" class="dropzone"></div>
                    </div>
                    @error('photo_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

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
@section('scripts')

    <script type='text/javascript'>
        // $(document).ready(function(){
        //     $('#category_id').change(function(){
        //         // Empty the dropdown
        //         $('#category_id').find('option').not(':first').remove();
        //
        //         // AJAX request
        //         $.ajax({
        //             url: '/api/categories',
        //             type: 'get',
        //             dataType: 'json',
        //             success: function(response){
        //                 var len = 0;
        //                 if(response['data'] != null){
        //                     len = response['data'].length;
        //                 }
        //
        //                 if(len > 0){
        //                     // Read data and create <option >
        //                     for(var i=0; i<len; i++){
        //
        //                         var id = response['data'][i].id;
        //                         var name = response['data'][i].name;
        //
        //                         var option = "<option value='"+id+"'>"+name+"</option>";
        //
        //                         $("#category_id").append(option);
        //                     }
        //                 }
        //
        //             }
        //         });
        //         });
        //
        // });
    </script>


<script type="text/javascript" src="{{asset('/admin/dist/js/dropzone.js')}}"></script>
    <script>
        var csrf_token = "{{ csrf_token() }}";
        var dropzone = new Dropzone('#photo', {
            addRemoveLinks:true,
            maxFiles:1,
            url: "{{route('photos.upload')}}",
            sending:function (file,xhr,formData) {
            formData.append("_token",csrf_token)
            },
            success: function (file,response) {
                document.getElementById('photo_id').value=response.photo_id;

            }
        });

    </script>
    @endsection
