@extends('backend.layouts.app')

@section('title', __('Tambah Provider'))

@section('content')
    <x-forms.post :action="route('admin.provider.store')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                Tambah Provider
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.provider.index')" :text="__('Batal')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">Nama</label>
                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Nama') }}"
                            value="{{ old('name') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="code" class="col-md-2 col-form-label">Kode</label>
                    <div class="col-md-10">
                        <input type="text" name="code" class="form-control" placeholder="{{ __('Kode') }}"
                            value="{{ old('code') }}" maxlength="10" required />
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($logged_in_user->can('admin.access.provider.store'))
                    <button class="btn btn-sm btn-primary float-right" type="submit">Simpan</button>
                @endif
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    @include('backend.layouts.ckeditor')
@endpush
