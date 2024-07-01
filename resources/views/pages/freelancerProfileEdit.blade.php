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
                        <h5 class="card-title">Edit Freelancer Profile</h5>
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

                        <form action="{{ route('freelancers.update', $freelancer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="location">Location</label>
                                <div class="input-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                    </div>
                                    <select class="form-control" id="location" name="location" required>
                                        <option value="" disabled>{{ __('Select area') }}</option>
                                        <option value="Shah Alam" {{ (old('location', $freelancer->location) == 'Shah Alam') ? 'selected' : '' }}>{{ __('Shah Alam') }}</option>
                                        <option value="Subang Jaya" {{ (old('location', $freelancer->location) == 'Subang Jaya') ? 'selected' : '' }}>{{ __('Subang Jaya') }}</option>
                                        <option value="Klang" {{ (old('location', $freelancer->location) == 'Klang') ? 'selected' : '' }}>{{ __('Klang') }}</option>
                                        <!-- Add other locations as needed -->
                                    </select>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="work_experience">Work Experience</label>
                                <input type="text" name="work_experience" class="form-control" value="{{ $freelancer->work_experience }}" required>
                            </div>
                            <div class="form-group">
                                <label for="edu_quality">Education Quality</label>
                                <input type="text" name="edu_quality" class="form-control" value="{{ $freelancer->edu_quality }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nickname">Nickname</label>
                                <input type="text" name="nickname" class="form-control" value="{{ $freelancer->nickname }}" required>
                            </div>
                                                        
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('freelancers.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
