@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h2>Edit Permission</h2>
                <div>
                   <form action="{{route('updatePermission')}}" method="post">
                   @csrf
                   <div class="form-group row">
                        <div class="col  s6">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $permission['name']  }}" required autocomplete="name" autofocus>
                            
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col  s6">
                            <label for="key" class="col-md-4 col-form-label text-md-right">{{ __('Key') }}</label>
                            <input type="text" class="form-control @error('key') is-invalid @enderror"
                                 value="{{  $permission['key'] }}" required autocomplete="key" autofocus disabled>
                            
                            @error('key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                     <div class="form-group row">
                        <div class="col  s12">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ $permission['description'] }}" required autocomplete="description" autofocus>
                            
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col  s12">
                        <select id="category" name="category" required>
                            <option value="" disabled selected>Choose your option</option>
                            @foreach($permissions as $key=>$value)
                            <option value="{{$key}}" {{($key == $permission['category']) ? 'selected' : ''}}>{{$key}}</option>
                            @endforeach
                            <option value="new">New</option>
                        </select>
                            <label>Category</label>
                            <span id="new"></span>
                        </div>
                    </div> 
                        <input type="hidden" name="id" value="{{$permission['id']}}">
                       <button type="submit" class="waves-effect waves-light btn">Submit</button> 
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')

<script>
 $(document).ready(function(){
    $('select').formSelect();
  });
  </script>

  <script>
function string_to_slug(str, separator) {
    str = str.trim();
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    const from = "åàáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
    const to = "aaaaaaeeeeiiiioooouuuunc------";

    for (let i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
    }

    return str
        .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
        .replace(/\s+/g, "-") // collapse whitespace and replace by -
        .replace(/-+/g, "-") // collapse dashes
        .replace(/^-+/, "") // trim - from start of text
        .replace(/-+$/, "") // trim - from end of text
        .replace(/-/g, separator);
}
$(document).ready(function() {
    $("#name").keyup(function() {
        val = $("#name").val();
        $("#key").val(string_to_slug(val, '_'));
    });
    $("#category").change(function(){
        let cat = $(this).val(); 
        if(cat == 'new')
        {
            let html = '<input name="category" placeholder="Enter New Category Name" type="text" class="form-control" required>'; 
            $("#new").html(html);
        }
        else
        {
            $("#new").html('');
        }
    });
});

</script>

@if(Session::has('success'))
    <script>
    M.toast({html: '{{Session::get('success')}}', classes: 'rounded'});
    </script>
@endif
@endsection
