<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->description }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->scope=='news')
        Berita
    @elseif($row->scope=='donation')
        Donasi
    @elseif($row->scope=='event')
        Acara
    @elseif($row->scope=='vacancy')
        Lowongan
    @elseif($row->scope=='videos')
        Videos
    @elseif($row->scope=='banner')
        Banner
    @elseif($row->scope=='promo')
        Promo
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.category.includes.actions', ['category' => $row])
</x-livewire-tables::bs4.table.cell>
