@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.appointments.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="client_id">{{ trans('cruds.appointment.fields.client') }}</label>
                    <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                        @foreach($clients as $id => $entry)
                            <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('client'))
                        <div class="invalid-feedback">
                            {{ $errors->first('client') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.client_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="employees_id">{{ trans('cruds.appointment.fields.employees') }}</label>
                    <select class="form-control select2 {{ $errors->has('employees') ? 'is-invalid' : '' }}" name="employees_id" id="employees_id">
                        @foreach($employees as $id => $entry)
                            <option value="{{ $id }}" {{ old('employees_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('employees'))
                        <div class="invalid-feedback">
                            {{ $errors->first('employees') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.employees_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="start_time">{{ trans('cruds.appointment.fields.start_time') }}</label>
                    <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                    @if($errors->has('start_time'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_time') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.start_time_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}</label>
                    <input class="form-control datetime {{ $errors->has('finish_time') ? 'is-invalid' : '' }}" type="text" name="finish_time" id="finish_time" value="{{ old('finish_time') }}" required>
                    @if($errors->has('finish_time'))
                        <div class="invalid-feedback">
                            {{ $errors->first('finish_time') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.finish_time_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="price">{{ trans('cruds.appointment.fields.price') }}</label>
                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                    @if($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.price_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="services">{{ trans('cruds.appointment.fields.services') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('services') ? 'is-invalid' : '' }}" name="services[]" id="services" multiple>
                        @foreach($services as $id => $service)
                            <option value="{{ $id }}" {{ in_array($id, old('services', [])) ? 'selected' : '' }}>{{ $service }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('services'))
                        <div class="invalid-feedback">
                            {{ $errors->first('services') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.services_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
