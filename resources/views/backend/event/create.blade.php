@extends('backend.layouts.app')

@section('title', __('Tambah Acara'))

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <x-forms.post :action="route('admin.event.store')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                Tambah Acara
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.event.index')" :text="__('Batal')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label for="category_id" class="col-md-2 col-form-label">Kategori</label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">Nama Acara</label>
                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Nama Acara') }}"
                            value="{{ old('name') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                    <div class="col-md-10">
                        <textarea class="form-control ckeditor" placeholder="Deskripsi" name="description" id="description"
                            rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="location" class="col-md-2 col-form-label">Lokasi</label>
                    <div class="col-md-10">
                        <input type="text" name="location" class="form-control" placeholder="{{ __('Lokasi') }}"
                            value="{{ old('location') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="host" class="col-md-2 col-form-label">Tuan Rumah</label>
                    <div class="col-md-10">
                        <input type="text" name="host" class="form-control" placeholder="{{ __('Tuan Rumah') }}"
                            value="{{ old('host') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_from" class="col-md-2 col-form-label">Acara</label>
                    <label for="date_from" class="col-md-2 col-form-label">Mulai</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="date_from" class="form-control datepicker"
                            placeholder="{{ __('Acara mulai') }}" value="{{ old('date_from') }}" maxlength="200"
                            required />
                    </div>
                    <label for="date_end" class="col-md-2 col-form-label">Selesai</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="date_end" class="form-control datepicker"
                            placeholder="{{ __('Acara selesai') }}" value="{{ old('date_end') }}" maxlength="200"
                            required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="published" class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <div class="form-check">
                            <input name="published" id="published" class="form-check-input" type="checkbox"
                                value="published" @if (old('published')) checked @endif>
                            <label class="form-check-label" for="published">Publik</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="published_start" class="col-md-2 col-form-label">Mulai Publikasi</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="published_start" class="form-control datepicker"
                            placeholder="{{ __('Mulai Publikasi') }}" value="{{ old('published_start') }}"
                            maxlength="200" required />
                    </div>
                    <label for="published_end" class="col-md-2 col-form-label">Berakhir Publikasi</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="published_end" class="form-control datepicker"
                            placeholder="{{ __('Berakhir Publikasi') }}" value="{{ old('published_end') }}"
                            maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="certificate_link" class="col-md-2 col-form-label">Link Sertifikat</label>
                    <div class="col-md-10">
                        <input type="text" name="certificate_link" class="form-control"
                            placeholder="{{ __('Link Sertifikat') }}" value="{{ old('certificate_link') }}"
                            maxlength="200" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="register_link" class="col-md-2 col-form-label">Link Daftar</label>
                    <div class="col-md-10">
                        <input type="text" name="register_link" class="form-control"
                            placeholder="{{ __('Link Daftar') }}" value="{{ old('register_link') }}"
                            maxlength="200" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="source_link" class="col-md-2 col-form-label">Link Sumber</label>
                    <div class="col-md-10">
                        <input type="text" name="source_link" class="form-control"
                            placeholder="{{ __('Link Sumber') }}" value="{{ old('source_link') }}" maxlength="200" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">Gambar</label>
                    <div class="col-md-10">
                        <input onchange="readURL(this, 'image');" name="image" type="file"
                            accept="image/gif, image/jpeg, image/png" id="image">
                        <div class="invalid-feedback" id="image_error"></div>
                        <div id="image-display">
                            <img id="blah-image" src="{{ asset('no-image.jpg') }}" alt="Mengambil Foto ..."
                                class="mt-2" style="height: 200px;">
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($logged_in_user->can('admin.access.event.store'))
                    <button class="btn btn-sm btn-primary float-right" type="submit">Simpan</button>
                @endif
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                dateFormat: "dd-mm-yy"
            });
        });
    </script>
    @include('backend.layouts.ckeditor')
@endpush
