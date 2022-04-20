@extends('backend.layouts.app')

@section('title', __('Tambah Kategori'))

@section('content')
    <x-forms.post :action="route('admin.category.store')">
        <x-backend.card>
            <x-slot name="header">
                Tambah Kategori
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.category.index')" :text="__('Batal')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">Nama</label>
                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Nama') }}" value="{{ old('name') }}" maxlength="500" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                    <div class="col-md-10">
                        <textarea class="form-control" required placeholder="Deskripsi" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="scope" class="col-md-2 col-form-label">Scope</label>
                    <div class="col-md-10">
                        <select name="scope" class="form-control" required>
                            <option value="news">Berita</option>
                            <option value="donation">Donasi</option>
                            <option value="event">Acara</option>
                            <option value="vacancy">Lowongan</option>
                            <option value="videos">Video</option>
                            <option value="banner">Banner</option>
                            <option value="promo">Promo</option>
                        </select>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
            @if ($logged_in_user->can('admin.access.category.store'))
                <button class="btn btn-sm btn-primary float-right" type="submit">Simpan</button>
            @endif
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
@endpush
