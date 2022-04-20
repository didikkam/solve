@extends('backend.layouts.app')

@section('title', __('Edit Lowongan'))

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <x-forms.post :action="route('admin.vacancy.store')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                Edit Lowongan
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.vacancy.index')" :text="__('Batal')" />
            </x-slot>
            <x-slot name="body">
                <input type="hidden" value="{{ $data->id }}" name="id">
                <div class="form-group row">
                    <label for="category_id" class="col-md-2 col-form-label">Kategori</label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id === $data->category_id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-md-2 col-form-label">Tipe Pekerajaan</label>
                    <div class="col-md-10">
                        <select name="type" class="form-control" required>
                            <option value="full-time" {{ $data->type === 'full-time' ? 'selected' : '' }}>Full Time
                            </option>
                            <option value="part-time" {{ $data->type === 'part-time' ? 'selected' : '' }}>Part Time
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">Nama Lowongan</label>
                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Nama Lowongan') }}"
                            value="{{ old('name') ?? $data->name }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="position" class="col-md-2 col-form-label">Posisi Sebagai</label>
                    <div class="col-md-10">
                        <input type="text" name="position" class="form-control" placeholder="{{ __('Posisi Sebagai') }}"
                            value="{{ old('position') ?? $data->position }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                    <div class="col-md-10">
                        <textarea class="form-control ckeditor" placeholder="Deskripsi" name="description" id="description" rows="3"
                            required>{{ old('description') ?? $data->description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-md-2 col-form-label">Alamat</label>
                    <div class="col-md-10">
                        <input type="text" name="address" class="form-control" placeholder="{{ __('Alamat') }}"
                            value="{{ old('address') ?? $data->address }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="company" class="col-md-2 col-form-label">Perusahaan</label>
                    <div class="col-md-10">
                        <input type="text" name="company" class="form-control" placeholder="{{ __('Perusahaan') }}"
                            value="{{ old('company') ?? $data->company }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="published" class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <div class="form-check">
                            <input name="published" id="published" class="form-check-input" type="checkbox"
                                value="published" @if (old('published') || $data->published == 'published') checked @endif>
                            <label class="form-check-label" for="published">Publik</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="published_start" class="col-md-2 col-form-label">Mulai Publikasi</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="published_start" class="form-control datepicker"
                            placeholder="{{ __('Mulai Publikasi') }}"
                            value="{{ old('published_start') ?? date('d-m-Y', strtotime($data->published_start)) }}"
                            maxlength="200" required />
                    </div>
                    <label for="published_end" class="col-md-2 col-form-label">Berakhir Publikasi</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="published_end" class="form-control datepicker"
                            placeholder="{{ __('Berakhir Publikasi') }}"
                            value="{{ old('published_end') ?? date('d-m-Y', strtotime($data->published_end)) }}"
                            maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="source_link" class="col-md-2 col-form-label">Link Sumber</label>
                    <div class="col-md-10">
                        <input type="text" name="source_link" class="form-control"
                            placeholder="{{ __('Link Sumber') }}"
                            value="{{ old('source_link') ?? $data->source_link }}" maxlength="200" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">Gambar</label>
                    <div class="col-md-10">
                        <input onchange="readURL(this, 'image');" name="image" type="file"
                            accept="image/gif, image/jpeg, image/png" id="image">
                        <div class="invalid-feedback" id="image_error"></div>
                        <div id="image-display">
                            <img id="blah-image" src="{{ $data->image }}" alt="Mengambil Foto ..." class="mt-2"
                                style="height: 200px;">
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($logged_in_user->can('admin.access.vacancy.store'))
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
