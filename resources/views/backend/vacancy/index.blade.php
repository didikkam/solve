@extends('backend.layouts.app')

@section('title', __('Lowongan'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Lowongan
        </x-slot>

        @if ($logged_in_user->can('admin.access.vacancy.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.vacancy.create')"
                    :text="__('Tambah')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.vacancy-table />
        </x-slot>
    </x-backend.card>
@endsection
