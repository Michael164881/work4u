@extends('customer.app', [
    'class' => '',
    'elementActive' => 'profile'
])

<style>
    #whole-card {
        background-color: #7C638F;
        color: white;
    }

    .title-text {
        font-size: 20px;
        margin-bottom: 5px;
    }

    .title {
        font-weight: bolder;
        font-size: 30px;
    }

    #description {
        color: #c8ccc9;
    }

    .title-ewallet {
        color: white;
        letter-spacing: 5px;
        margin-bottom: 10px;
    }

    .amount {
        font-weight: bolder;
    }

    .custom-file-label::after {
        content: "Browse";
    }
</style>

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user" id="whole-card">
                    <div class="image">
                        <img src="{{ asset('paper/img/damir-bosnjak.jpg') }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            @if(auth()->user()->profile_picture)
                                <img class="avatar border-gray" src="{{ asset(auth()->user()->profile_picture) }}" alt="...">
                            @else
                                <img class="avatar border-gray" src="{{ asset('paper/img/mike.jpg') }}" alt="...">
                            @endif
                            <h5 class="title">{{ __(auth()->user()->name)}}</h5><br><br>
                            
                            <h2 class="title-text">Email</h2>
                            <p class="description" id="description">{{ __(auth()->user()->email)}}</p><br>

                            <h2 class="title-text">IC</h2>
                            <p class="description" id="description">{{ __(auth()->user()->ic)}}</p><br>

                            <h2 class="title-text">Phone Number</h2>
                            <p class="description" id="description">{{ __(auth()->user()->phone_number)}}</p><br>

                            <h2 class="title-text">Location</h2>
                            <p class="description" id="description">{{ __(auth()->user()->location)}}</p><br>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <h1 class="title-ewallet">E-WALLET</h1><br><br>
                                    <h5 class="amount">RM {{ __(auth()->user()->ewallet_balance)}}
                                        <br>
                                        <small>{{ __('BALANCE') }}</small>
                                    </h5><br>
                                    <a class="btn btn-info btn-round" href="{{ route('top-up.payment-method') }}">{{ __('TOP UP') }}</a>
                        </div>
                    <!-- End Card Footer -->    
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-center">


                <!-- Edit profile -->
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Edit Profile') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('NAME') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ auth()->user()->name }}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('EMAIL') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('IC') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="ic" name="ic" class="form-control" placeholder="IC" value="{{ auth()->user()->ic }}" required>
                                    </div>
                                    @if ($errors->has('ic'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('ic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('PHONE NUMBER') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone_number }}" required>
                                    </div>
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('LOCATION') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="location" name="location" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->location }}" required>
                                    </div>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Profile Picture') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="profile_picture" class="custom-file-input" id="profilePicture" accept="image/*">
                                            <label class="custom-file-label" for="profilePicture">{{ __('Choose file') }}</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('profile_picture'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('profile_picture') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" style="background-color: #7C638F;" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!--Change Password-->
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Change Password') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" style="background-color: #7C638F;" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection