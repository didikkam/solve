<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Provider;

class ProviderTable extends DataTableComponent
{

   public function columns(): array
   {
      return [
         Column::make("Name", "name")
            ->sortable(),
         Column::make("Code", "code")
            ->sortable(),
         Column::make(__('Aksi')),
      ];
   }

   public function query(): Builder
   {
      $query = Provider::query();
      $query = $query->orderBy('created_at', 'desc');
      return $query;
   }

   public function rowView(): string
   {
      return 'backend.provider.includes.row';
   }
}
