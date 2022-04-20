{{-- <x-livewire-tables::bs4.table.cell>
    {{ $row->id }}
</x-livewire-tables::bs4.table.cell> --}}

<x-livewire-tables::bs4.table.cell>
    <img src="{{ $row->image }}" alt="Image" width="100">
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->title }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->view_as=='headline')
        <span class="badge badge-danger">HEADLINE</span>
    @elseif ($row->view_as=='list')
        <span class="badge badge-info">LIST</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->status=='published')
        <span class="badge badge-success">PUBLIK</span>
    @elseif ($row->status=='draft')
        <span class="badge badge-warning">DRAFT</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.media_news.includes.actions', ['media_news' => $row])
</x-livewire-tables::bs4.table.cell>
