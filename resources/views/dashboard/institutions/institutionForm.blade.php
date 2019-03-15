<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" action="{{route('institution_save')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($institution) ? $institution->name : '' }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="col-md-9">
                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ isset($institution) ? $institution->address : '' }}" required autofocus>

                        @if ($errors->has('address'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hours" class="col-sm-3 col-form-label text-md-right">{{ __('Working hours') }}</label>

                    <div class="col-md-9">
                        <input id="hours" type="text" class="form-control{{ $errors->has('hours') ? ' is-invalid' : '' }}" name="hours" value="{{ isset($institution) ? $institution->hours : '' }}" required autofocus>

                        @if ($errors->has('hours'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('hours') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="website" class="col-sm-3 col-form-label text-md-right">{{ __('Website') }}</label>

                    <div class="col-md-9">
                        <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ isset($institution) ? $institution->website : '' }}" autofocus>

                        @if ($errors->has('website'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('website') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label text-md-right">{{ __('Phone') }}</label>

                    <div class="col-md-9">
                        <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ isset($institution) ? $institution->phone : '' }}" required autofocus>

                        @if ($errors->has('phone'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label text-md-right">{{ __('E-mail') }}</label>

                    <div class="col-md-9">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ isset($institution) ? $institution->email : '' }}" autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type_id" class="col-sm-3 col-form-label text-md-right">{{ __('Type') }}</label>

                    <div class="col-md-9">
                        <select name="type_id" class="form-control{{ $errors->has('type_id') ? ' is-invalid' : '' }}" required>
                            @foreach ($types as $type)
                                <option {{isset($institution) && $type->id == $institution->type_id ? 'selected' : ''}} value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('type_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('type_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city_id" class="col-sm-3 col-form-label text-md-right">{{ __('City') }}</label>

                    <div class="col-md-9">
                        <select name="city_id" class="form-control{{ $errors->has('city_id') ? ' is-invalid' : '' }}" required>
                        @foreach ($cities as $city)
                            <option {{isset($institution) && $city->id == $institution->city_id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        </select>

                        @if ($errors->has('city_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('city_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($institution))
                    <input type="hidden" name="id" value="{{$institution->id}}" />
                @endif
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
