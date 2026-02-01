@extends('backend.layouts.app')

@section('content')
    <x-backend::common.page-breadcrumb pageTitle="Form Elements" />
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
        <div class="space-y-6">
            <x-backend::form.form-elements.default-inputs />
            <x-backend::form.form-elements.select-inputs />
            <x-backend::form.form-elements.text-area-inputs />
            <x-backend::form.form-elements.input-states />
        </div>
        <div class="space-y-6">
            <x-backend::form.form-elements.input-group />
            <x-backend::form.form-elements.file-input-example />
            <x-backend::form.form-elements.checkbox-component />
            <x-backend::form.form-elements.radio-buttons />
            <x-backend::form.form-elements.toggle-switch />
            <x-backend::form.form-elements.dropzone />
        </div>
    </div>
@endsection
