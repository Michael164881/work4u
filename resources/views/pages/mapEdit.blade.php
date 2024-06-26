@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'userM'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit User</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ic">IC</label>
                                <input type="text" name="ic" class="form-control" value="{{ $user->ic }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <div class="input-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <select class="form-control" id="location" name="location" required>
                                        <option value="" disabled>{{ __('Select area') }}</option>
                                        <option value="Shah Alam" {{ (old('location') == 'Shah Alam' || $user->location == 'Shah Alam') ? 'selected' : '' }}>{{ __('Shah Alam') }}</option>
                                        <option value="Subang Jaya" {{ (old('location') == 'Subang Jaya' || $user->location == 'Subang Jaya') ? 'selected' : '' }}>{{ __('Subang Jaya') }}</option>
                                        <option value="Klang" {{ (old('location') == 'Klang' || $user->location == 'Klang') ? 'selected' : '' }}>{{ __('Klang') }}</option>
                                        <option value="Petaling Jaya" {{ (old('location') == 'Petaling Jaya' || $user->location == 'Petaling Jaya') ? 'selected' : '' }}>{{ __('Petaling Jaya') }}</option>
                                        <option value="Ampang Jaya" {{ (old('location') == 'Ampang Jaya' || $user->location == 'Ampang Jaya') ? 'selected' : '' }}>{{ __('Ampang Jaya') }}</option>
                                        <option value="Batu Caves" {{ (old('location') == 'Batu Caves' || $user->location == 'Batu Caves') ? 'selected' : '' }}>{{ __('Batu Caves') }}</option>
                                        <option value="Puchong" {{ (old('location') == 'Puchong' || $user->location == 'Puchong') ? 'selected' : '' }}>{{ __('Puchong') }}</option>
                                        <option value="Seri Kembangan" {{ (old('location') == 'Seri Kembangan' || $user->location == 'Seri Kembangan') ? 'selected' : '' }}>{{ __('Seri Kembangan') }}</option>
                                        <option value="Kuala Lumpur" {{ (old('location') == 'Kuala Lumpur' || $user->location == 'Kuala Lumpur') ? 'selected' : '' }}>{{ __('Kuala Lumpur') }}</option>
                                    </select>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <div class="input-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="" disabled>{{ __('Choose role') }}</option>
                                        <option value="freelancer" {{ old('role', $user->role) == 'freelancer' ? 'selected' : '' }}>{{ __('Freelancer') }}</option>
                                        <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>{{ __('Customer') }}</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                                <small class="form-text text-muted">Leave blank to keep current password.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
