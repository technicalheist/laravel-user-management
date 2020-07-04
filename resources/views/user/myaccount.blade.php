@extends('layouts.app')

@section('content')
<style>
.invalid-feedback{
    color:red;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        

                <h3>{{ __('My Account') }}</h3>
                <p> Leave the password field empty, if not changing</p>

                <div >
                    <form method="POST" action="{{ route('myaccount') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user['name'] }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} (Email cannot be changed)</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user['email'] }}" required autocomplete="email" disabled>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                             <div class="input-field col s12">
                                <select name="user_type" disabled>
                                <option value="" disabled selected>Choose your option</option>
                                <option value="1" {{ ($user['user_type'] == 1)? 'selected' : ''  }}>Admin</option>
                                <option value="2" {{ ($user['user_type'] == 2)? 'selected' : ''  }}>User</option>
                                </select>
                                <label>User Type (Admin can change the role)</label>
                                 @error('user_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="edit" class="btn btn-primary">
                                    {{ __('Update') }}
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
    var instances = M.FormSelect.init(elems, options=null);
  });

  @if(Session::has('success'))
     M.toast({html: '{{Session::get('success')}}', classes: 'rounded'});
  @endif
  </script>
  @endsection