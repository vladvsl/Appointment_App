@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.appointments.update", [$appointment->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="client_id">{{ trans('cruds.appointment.fields.client') }}</label>
                    <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                        @foreach($clients as $id => $entry)
                            <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $appointment->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <option value="{{ $id }}" {{ (old('employees_id') ? old('employees_id') : $appointment->employees->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('employees'))
                        <div class="invalid-feedback">
                     @endif
    {{ $errors->first('employees') }}
