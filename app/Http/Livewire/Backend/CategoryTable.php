<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;

class CategoryTable extends DataTableComponent
{

   public function columns(): array
   {
      return [
         // Column::make("Id", "id")
         //     ->sortable(),
         Column::make("Nama", "name")
            ->searchable(),
         Column::make("Deskripsi", "description"),
         Column::make("Scope", "scope")
            ->searchable(),
         Column::make(__('Aksi')),
      ];
   }

   public function query(): Builder
   {
      return Category::query()->orderBy('created_at', 'desc');
   }

   /**
    * @return string
    */
   public function rowView(): string
   {
      return 'backend.category.includes.row';
   }
}
