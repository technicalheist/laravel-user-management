@extends('layouts.app')

@section('content')
<style>
.invalid-feedback {
    color: red;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h3>{{ __('Create New User') }}</h3>

            <div>
                <form method="POST" action="{{ route('createUser') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" autocomplete="new-password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="input-field col s12">
                            <select name="user_type" id="user_type">
                                <option value="" disabled selected>Choose your option</option>
                                 @if(isAdmin())
                                <option value="1" {{ (old('user_type') == 1)? 'selected' : ''  }}>Admin</option>
                                @endif
                                <option value="2" {{ (old('user_type') == 2)? 'selected' : ''  }}>Staff</option>
                                <option value="3" {{ (old('user_type') == 3)? 'selected' : ''  }}>User</option>
                            </select>
                            <label>User Type</label>
                            @error('user_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @if(isAdmin())
                    <div class="form-group row permission">
                    <label class="col-md-4 col-form-label text-md-right"><h5>{{ __('Permission') }}</h5></label>
                            <hr/>
                        @foreach($permission_list as $key => $value)
                        <label class="col-md-4 col-form-label text-md-right"><p>{{ $key }}</label>
                             @foreach($value as $val)
                                <div class="col-md-6">
                                    <label>
                                        <input name="permission[]" value="{{$val['key']}}" type="checkbox" />
                                        <span>{{$val['name']}} ({{$val['description']}})</span>
                                    </label><br>
                                </div>
                             @endforeach 
                             <hr/>      
                        @endforeach
                    </div>
                    @else
                     <div class="form-group row permission">
                     <strong>Please contact admin to add Permission</strong>
                     </div>
                    @endif
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="create" class="btn btn-primary">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection


@section('footer_script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options = null);
});

$(document).ready(function(){
    $(".permission").hide();
    utype = $("#user_type").val();
    if(utype == 2)
    {
    $(".permission").show();
    }
    else
    {
    $(".permission").hide();
    }
    $("#user_type").change(function(){
        val = $(this).val();
        if(val == 2)
        {
            $(".permission").show();
        }
        else
        {
            $(".permission").hide();
        }
    })
})

@if(Session::has('success'))
M.toast({html: '{{Session::get('success')}}', classes: 'rounded'});
@endif
</script>
@endsection
