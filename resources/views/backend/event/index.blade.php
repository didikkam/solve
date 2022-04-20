@extends('backend.layouts.app')

@section('title', __('Acara'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Acara
        </x-slot>

        @if ($logged_in_user->can('admin.access.event.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.event.create')"
                    :text="__('Tambah')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.event-table />
        </x-slot>
    </x-backend.card>
@endsection
