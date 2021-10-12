<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.inc.header')
    </style>
  </head>
  <body>
    @include('admin.inc.sidebar')
      <!-- partial -->
      @include('admin.inc.navigation')
        <!-- partial -->
      <div class="main-panel">
        @include('admin.inc.messages')
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> SN </th>
                      <th> Product </th>
                      <th> Title </th>
                      <th> Description </th>
                      <th> Price </th>
                      <th> Quantity </th>
                      <th>Edit / Delete</th>
                    </tr>
                  </thead>
                  <tbody>                    
                    @if(count($products)>0)
                      @foreach($products as $product)
                        <tr>
                          <td> {{$loop->index+1}} </td>
                          <td class="py-1">
                            <img src="/storage/product_images/{{$product->image}}" alt="image" />
                          </td>
                          <td><a href="{{url('/product/'.$product->id)}}"> {{$product->title}}</a></td>
                          <td>{{$product->description}}</td>
                          <td>${{$product->price}}</td>
                          <td>{{$product->quantity}}</td>

                          <td>
                            <a href="{{url('/product/'.$product->id.'/edit')}}"><i class="mdi mdi-pencil"></i></a>
                            {!!Form::open(['action'=>['App\Http\Controllers\ProductController@destroy',$product->id], 'method'=>'POST'])!!}
                            {{Form::hidden('_method','DELETE')}}
                            <button type="submit"><i class="mdi mdi-delete"></i></button>
                            {{Form::close()}}
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


        @include('admin.inc.footer')
  </body>
</html>
