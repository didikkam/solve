@extends('backend.layouts.app')

@section('title', __('Provider'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Provider
        </x-slot>

        @if ($logged_in_user->can('admin.access.provider.create'))
            <x-slot name="headerActions">
                <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.provider.create')"
                    :text="__('Tambah')" />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.provider-table />
        </x-slot>
    </x-backend.card>
@endsection
