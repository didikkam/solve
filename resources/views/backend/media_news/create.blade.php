@extends('backend.layouts.app')

@section('title', __('Tambah Berita'))

@section('content')
    <x-forms.post :action="route('admin.media_news.store')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                Tambah Berita
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.media_news.index')" :text="__('Batal')" />
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
                    <label for="title" class="col-md-2 col-form-label">Judul</label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" placeholder="{{ __('Judul') }}"
                            value="{{ old('title') }}" maxlength="200" required />
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
                    <label for="view_as" class="col-md-2 col-form-label">Tampilkan Sebagai</label>
                    <div class="col-md-10">
                        <div class="form-check">
                            <input name="view_as" id="view_as" class="form-check-input" type="checkbox" value="headline"
                                @if (old('view_as')) checked @endif>
                            <label class="form-check-label" for="view_as">Headline</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                        <div class="form-check">
                            <input name="status" id="status" class="form-check-input" type="checkbox" value="published"
                                @if (old('status')) checked @endif>
                            <label class="form-check-label" for="status">Publik</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="source_link" class="col-md-2 col-form-label">Link Sumber</label>
                    <div class="col-md-10">
                        <input type="text" name="source_link" class="form-control" placeholder="{{ __('Link Sumber') }}"
                            value="{{ old('source_link') }}" maxlength="200" />
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
                @if ($logged_in_user->can('admin.access.media_news.store'))
                    <button class="btn btn-sm btn-primary float-right" type="submit">Simpan</button>
                @endif
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    @include('backend.layouts.ckeditor')
@endpush
