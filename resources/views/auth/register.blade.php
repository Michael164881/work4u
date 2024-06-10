<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />

<style>
    body{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .content{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-body{
        width: 80%;
        margin: 5% 0 5% 0;
    }

    .card-title{
        text-align: center;
        margin: 10% 0 10% 0;
    }

    #in-container{
        background-color: #7C638F;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30vw;
    }

    h4{
        color: white;
        font-weight: bolder;
    }

    #txt-agree{
        color: white;
    }

    input{
        width: 100%;
    }

    select{
        width: 100%;
    }

    #reg-btn{
        background-color: #ffcc00;
    }
</style>

    <div class="content">
        <div class="card card-signup text-center" id="in-container">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('CREATE ACCOUNT') }}</h4>
                            
                            <form class="form" method="POST" action="{{ route('register') }}">

                                <!--Name-->
                                @csrf
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- IC -->
                                <div class="input-group{{ $errors->has('ic') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input name="ic" type="text" class="form-control" placeholder="IC" value="{{ old('ic') }}" required>
                                    @if ($errors->has('ic'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('ic') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- Email -->
                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        
                                    </div>
                                    <input name="email" type="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- Phone Number -->
                                <div class="input-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input name="phone_number" type="text" class="form-control" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- Location -->
                                <div class="input-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input name="location" type="text" class="form-control" placeholder="Location" value="{{ old('location') }}" required>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <!-- Role -->
                                <div class="input-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="" selected disabled>{{ __('Choose role') }}</option>
                                        <option value="freelancer" {{ old('role') == 'freelancer' ? 'selected' : '' }}>{{ __('Freelancer') }}</option>
                                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>{{ __('Customer') }}</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div><br><br>

                                <!-- Password -->
                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        
                                    </div>
                                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        
                                    </div>
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Password confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-check text-left">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="agree_terms_and_conditions" type="checkbox">
                                        <span class="form-check-sign"></span>
                                            <div id="txt-agree">{{ __('I agree to the') }} <a href="#something">{{ __('terms and conditions') }}</a>.</div>
                                    </label>
                                    @if ($errors->has('agree_terms_and_conditions'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('agree_terms_and_conditions') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round" id="reg-btn">{{ __('REGISTER') }}</button>
                                </div>
                            </form>
                        </div> 
        </div>               
     </div> 
