@extends('backend.layouts.app')

@section('title', __('Tambah Berita'))

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <x-forms.post :action="route('admin.timesheet.store')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                Tambah Berita
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.timesheet.index')" :text="__('Batal')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label for="date" class="col-md-2 col-form-label">Tanggal</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="date" class="form-control datepicker"
                            placeholder="{{ __('Tanggal') }}" value="{{ old('date') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="client_id" class="col-md-2 col-form-label">Klien</label>
                    <div class="col-md-10">
                        <select name="client_id" class="form-control" required>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_pek" class="col-md-2 col-form-label">Kode Pekerjaan</label>
                    <div class="col-md-10">
                        <input type="text" name="kode_pek" class="form-control" placeholder="{{ __('Kode Pekerjaan') }}"
                            value="{{ old('kode_pek') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_penugasan" class="col-md-2 col-form-label">Jenis Penugasan</label>
                    <div class="col-md-10">
                        <input type="text" name="jenis_penugasan" class="form-control"
                            placeholder="{{ __('Jenis Penugasan') }}" value="{{ old('jenis_penugasan') }}"
                            maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-md-2 col-form-label">Tahun</label>
                    <div class="col-md-3">
                        <input type="text" autocomplete="off" name="tahun" class="form-control datepicker"
                            placeholder="{{ __('Tahun') }}" value="{{ old('tahun') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_akun" class="col-md-2 col-form-label">Kode Akun</label>
                    <div class="col-md-10">
                        <input type="text" name="kode_akun" class="form-control" placeholder="{{ __('Kode Akun') }}"
                            value="{{ old('kode_akun') }}" maxlength="200" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="akun" class="col-md-2 col-form-label">Akun</label>
                    <div class="col-md-10">
                        <input type="text" name="akun" class="form-control" placeholder="{{ __('Akun') }}"
                            value="{{ old('akun') }}" maxlength="200" required />
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($logged_in_user->can('admin.access.timesheet.store'))
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
