<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" action="{{route('city_save')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($city) ? $city->name : '' }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="code" class="col-sm-3 col-form-label text-md-right">{{ __('Code') }}</label>

                    <div class="col-md-9">
                        <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ isset($city) ? $city->code : '' }}" required>

                        @if ($errors->has('code'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($city))
                    <input type="hidden" name="id" value="{{$city->id}}" />
                @endif
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
