<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" action="{{route('district_save')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($district) ? $district->name : '' }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city_id" class="col-sm-3 col-form-label text-md-right">{{ __('City') }}</label>

                    <div class="col-md-9">
                        <select name="city_id" class="form-control{{ $errors->has('city_id') ? ' is-invalid' : '' }}" required>
                        @foreach ($cities as $city)
                            <option {{isset($district) && $city->id == $district->city_id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        </select>

                        @if ($errors->has('city_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('city_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($district))
                    <input type="hidden" name="id" value="{{$district->id}}" />
                @endif
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
