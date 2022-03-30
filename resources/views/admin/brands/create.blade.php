@extends('admin.layout.master')
@section('styles')
<link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header border-transparent col-md-12">

                <h3 class="card-title">ایجاد برند جدید</h3>
            </div>

            <div class="box-body ">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <form action="/administrator/brands" method="post" >
@csrf
          <label for="name">عنوان :  </label>
           <div class="form-group">
               <input name="title" id="title" type="text" class="form-control" placeholder="عنوان  برند">
               </div>


                    <label for="meta_desc">توضیحات برند:  </label>
                    <div class="form-group">
                        <textarea name="description" id="description" type="text" class="form-control" placeholder="توضیحات برند"></textarea>

                    </div>
                    <label for="photo">تصویر :  </label>
                    <input type="hidden" name="photo_id" id="photo_id">
                    <div class="form-group">
                    <div id="photo" class="dropzone"></div>
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
