@extends('backend.layouts.app')

@section('title', __('Berita'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Berita
        </x-slot>

        @if ($logged_in_user->can('admin.access.media_news.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.media_news.create')"
                    :text="__('Tambah')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.media-news-table />
        </x-slot>
    </x-backend.card>
@endsection
