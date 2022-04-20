@extends('backend.layouts.app')

@section('title', __('Kategori'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Kategori
        </x-slot>

        @if ($logged_in_user->can('admin.access.category.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.category.create')"
                    :text="__('Tambah')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.category-table />
        </x-slot>
    </x-backend.card>
@endsection
