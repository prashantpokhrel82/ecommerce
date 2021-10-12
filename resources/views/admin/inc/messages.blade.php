@if(count($errors)>0)
  <div class="alert alert-danger">
    @foreach($errors->all() as $error)
        <p class="text-danger">{{'* '.$error}}</p>
    @endforeach
  </div>
@endif

@if(session('success'))
  <div class="alert alert-success">
    <button class="close" type="button" data-dismiss="alert">x</button>
    {{session('success')}}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-success">
    {{session('error')}}
  </div>
@endif
