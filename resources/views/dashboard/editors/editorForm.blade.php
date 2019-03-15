<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" action="{{route('editor_save')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($editor) ? $editor->name : '' }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-9">
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ isset($editor) ? $editor->description : '' }}</textarea>

                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city_id" class="col-sm-3 col-form-label text-md-right">{{ __('City') }}</label>

                    <div class="col-md-9">
                        <select name="city_id[]" class="form-control{{ $errors->has('city_id') ? ' is-invalid' : '' }}" multiple required>
                        @foreach ($cities as $city)
                            <option {{isset($editor) && in_array($city->id, $editor->cities->pluck('id')->toArray()) ? 'selected' : ''}} value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        </select>

                        @if ($errors->has('city_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('city_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($editor))
                    <input type="hidden" name="id" value="{{$editor->id}}" />
                @endif
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
