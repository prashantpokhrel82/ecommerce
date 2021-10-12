<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.inc.header')
    <style>
    .title{
      padding-top: 25px;
      font-size: 25px;
      color: white;
    }
    </style>
  </head>
  <body>
    @include('admin.inc.sidebar')
      <!-- partial -->
      @include('admin.inc.navigation')
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
          <div class="container" align="center">
            @include('admin.inc.messages')
            <h1 class="title">Add Product</h1>
            <div class="col-md-9 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  {!! Form::open(['action'=>'App\Http\Controllers\ProductController@store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group row">
                      <label for="title" class="col-sm-3 col-form-label">Title</label>
                      <div class="col-sm-9">
                        <input class="form-control" id="title" name="title" placeholder="Title">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="price" class="col-sm-3 col-form-label">Price</label>
                      <div class="col-sm-9">
                        <input class="form-control"  id="price" name="price" placeholder="Price">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" row="5" id="description" name="description" placeholder="Description"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="image" class="col-sm-3 col-form-label">Image</label>
                      <div class="col-sm-9">
                        <input type="file" class="form-control" id="image" name="image" placeholder="Upload Image">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success">Add Product</button>
                  {{Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </div>

        @include('admin.inc.footer')
  </body>
</html>
