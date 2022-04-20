@extends('backend.layouts.app')

@section('title', __('Recap'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Recap
        </x-slot>

        <x-slot name="body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">NAMA/INISIAL PERUSAHAAN</th>
                        <th scope="col">UARIAN PEKERJAAN</th>
                        <th scope="col">Kode Pek.</th>
                        @for ($i = 1; $i <= 31; $i++)
                            <th scope="col">{{ $i }}</th>
                        @endfor
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dat)
                        <tr>
                            <td>{{ $dat['client']['nama'] }}</td>
                            <td>{{ $dat['jenis_penugasan'] . date('d M Y', strtotime($dat['tahun'])) }}</td>
                            <td>{{ $dat['kode_pek'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection
