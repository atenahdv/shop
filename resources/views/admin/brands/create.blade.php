@extends('admin.layout.master')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header border-transparent col-md-12">

                <h3 class="card-title">ایجاد برند جدید</h3>
            </div>

            <div class="box-body ">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <form action="/administrator/brands" method="post">
@csrf
          <label for="name">عنوان :  </label>
           <div class="form-group">
               <input name="title" id="title" type="text" class="form-control" placeholder="عنوان  برند">
               </div>


                    <label for="meta_desc">توضیحات برند:  </label>
                    <div class="form-group">
                        <textarea name="description" id="description" type="text" class="form-control" placeholder="توضیحات برند"></textarea>

                    </div>


    <button type="submit" class=" pull-left btn btn-success">ذخیره</button>

                </form>

                    </div>
            </div>
            </div>



        </div>
    </section>
@endsection
