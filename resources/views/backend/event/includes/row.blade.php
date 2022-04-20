<x-livewire-tables::bs4.table.cell>
    <img src="{{ $row->image }}" alt="Image" width="100">
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->location }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->host }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->published=='published')
        <span class="badge badge-success">PUBLIK</span>
    @elseif ($row->published=='draft')
        <span class="badge badge-warning">DRAFT</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ date('d-m-Y', strtotime($row->date_from)) }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ date('d-m-Y', strtotime($row->date_end)) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.event.includes.actions', ['event' => $row])
</x-livewire-tables::bs4.table.cell>
