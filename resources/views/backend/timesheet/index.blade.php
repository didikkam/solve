@extends('backend.layouts.app')

@section('title', __('Time Sheet'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Time Sheet
        </x-slot>

        @if ($logged_in_user->can('admin.access.timesheet.create'))
            <x-slot name="headerActions">
                <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.timesheet.create')" :text="__('Tambah')" />
            </x-slot>
        @endif

        <x-slot name="body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Klien</th>
                        <th scope="col">Kode Pek.</th>
                        <th scope="col">Jenis Penugasan</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Kode Akun</th>
                        <th scope="col">Akun</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dat)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($dat['date'])) }}</td>
                            <td>{{ $dat['client']['nama'] }}</td>
                            <td>{{ $dat['kode_pek'] }}</td>
                            <td>{{ $dat['jenis_penugasan'] }}</td>
                            <td>{{ date('d M Y', strtotime($dat['tahun'])) }}</td>
                            <td>{{ $dat['kode_akun'] }}</td>
                            <td>{{ $dat['akun'] }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection
