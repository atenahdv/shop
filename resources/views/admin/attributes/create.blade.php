@extends('admin.layout.master')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header border-transparent col-md-12">

                <h3 class="card-title">ایجاد ویژگی جدید</h3>
            </div>

            <div class="box-body ">
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <form action="/administrator/attributes-group" method="post">
@csrf
          <label for="title">عنوان :  </label>
           <div class="form-group">
               <input name="title" id="title" type="text" class="form-control" placeholder="عنوان ویژگی ">
               </div>
                    <label for="type"> نوع :  </label>
                    <div class="form-group">

                        <select class="form-control" name="type" id="type">
                            <option value="select">لیست تکی</option>
                            <option value="multiple">لیست چندتایی</option>
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
