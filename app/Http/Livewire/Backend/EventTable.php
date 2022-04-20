<?php

namespace App\Http\Livewire\Backend;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class EventTable extends DataTableComponent
{

   public function columns(): array
   {
      return [
         Column::make("Gambar", "image"),
         Column::make("Nama", "name")
            ->searchable(),
         Column::make("Lokasi", "location")
            ->searchable(),
         Column::make("Tuan Rumah", "host")
            ->searchable(),
         Column::make("Status", "published"),
         Column::make("Mulai", "date_from"),
         Column::make("Selesai", "date_end"),
         Column::make(__('Aksi')),
      ];
   }

   public function filters(): array
   {
      $a = [
         '' => 'Semua',
      ];
      $categories = Category::query()->where('scope', 'event')->get();
      foreach ($categories as $category) {
         $a[$category->id] = $category->name;
      }
      return [
         'category_id' => Filter::make('Kategori')
            ->select($a),
         'published' => Filter::make('Status')
            ->select([
               '' => 'Semua',
               'draft' => 'Draf',
               'published' => 'Publik',
            ]),
      ];
   }

   public function query(): Builder
   {
      $query = Event::query();
      $query = $query->orderBy('created_at', 'desc');
      $user = Auth::user();
      if ($user->provider_id) {
         $query = $query->where('provider_id', $user->provider_id);
      }

      return $query
         ->when($this->getFilter('published'), fn ($query, $published) => $query->where('published', $published))
         ->when($this->getFilter('category_id'), fn ($query, $category_id) => $query->where('category_id', $category_id));
   }

   /**
    * @return string
    */
   public function rowView(): string
   {
      return 'backend.event.includes.row';
   }
}
