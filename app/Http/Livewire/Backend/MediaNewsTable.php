<?php

namespace App\Http\Livewire\Backend;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\MediaNews;
use Auth;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class MediaNewsTable extends DataTableComponent
{

   public function columns(): array
   {
      return [
         // Column::make("Id", "id")
         //     ->sortable(),
         Column::make("Gambar", "image"),
         Column::make("Judul", "title")
            ->searchable(),
         Column::make("Sebagai", "view_as")
            ->searchable(),
         Column::make("Status", "status")
            ->searchable(),
         Column::make(__('Aksi')),
      ];
   }

   public function filters(): array
   {
      $a = [
         '' => 'Semua',
      ];
      $categories = Category::query()->where('scope', 'news')->get();
      foreach ($categories as $category) {
         $a[$category->id] = $category->name;
      }
      return [
         'category_id' => Filter::make('Kategori')
            ->select($a),
         'view_as' => Filter::make('Sebagai')
            ->select([
               '' => 'Semua',
               'headline' => 'Headline',
               'list' => 'List',
            ]),
         'status' => Filter::make('Status')
            ->select([
               '' => 'Semua',
               'draft' => 'Draf',
               'published' => 'Publik',
            ]),
      ];
   }

   public function query(): Builder
   {
      $query = MediaNews::query();
      $query = $query->orderBy('created_at', 'desc');
      $user = Auth::user();
      if ($user->provider_id) {
         $query = $query->where('provider_id', $user->provider_id);
      }

      return $query
         ->when($this->getFilter('category_id'), fn ($query, $category_id) => $query->where('category_id', $category_id))
         ->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status))
         ->when($this->getFilter('view_as'), fn ($query, $view_as) => $query->where('view_as', $view_as));
   }

   /**
    * @return string
    */
   public function rowView(): string
   {
      return 'backend.media_news.includes.row';
   }
}
