<x-livewire-tables::bs4.table.cell>
    <img src="{{ $row->image }}" alt="Image" width="100">
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->categories->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->company }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->published=='published')
        <span class="badge badge-success">PUBLIK</span>
    @elseif ($row->published=='draft')
        <span class="badge badge-warning">DRAFT</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ date('d-m-Y', strtotime($row->published_start)) }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ date('d-m-Y', strtotime($row->published_end)) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.vacancy.includes.actions', ['vacancy' => $row])
</x-livewire-tables::bs4.table.cell>
