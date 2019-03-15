<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" action="{{route('institution_types_save')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($institution_type) ? $institution_type->name : '' }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($institution_type))
                    <input type="hidden" name="id" value="{{$institution_type->id}}" />
                @endif
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
