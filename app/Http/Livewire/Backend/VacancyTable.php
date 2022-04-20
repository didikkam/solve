<?php

namespace App\Http\Livewire\Backend;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class VacancyTable extends DataTableComponent
{

   public function columns(): array
   {
      return [
         Column::make("Gambar", "image"),
         Column::make("Nama", "name")
            ->searchable(),
         Column::make("Kategori", "categories.name")
            ->searchable(),
         Column::make("Perusahaan", "company")
            ->searchable(),
         Column::make("Status", "published")
            ->searchable(),
         Column::make("Mulai Publikasi", "published_start"),
         Column::make("Berakhir Publikasi", "published_end"),
         Column::make(__('Aksi')),
      ];
   }

   public function filters(): array
   {
      $a = [
         '' => 'Semua',
      ];
      $categories = Category::query()->where('scope', 'vacancy')->get();
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
      $query = Vacancy::query()
         ->with(['categories']);
      $query = $query->orderBy('created_at', 'desc');
      $user = Auth::user();
      if ($user->provider_id) {
         $query = $query->where('provider_id', $user->provider_id);
      }

      return $query
         ->when($this->getFilter('published'), fn ($query, $published) => $query->where('published', $published))
         ->when($this->getFilter('category_id'), fn ($query, $category_id) => $query->where('category_id', $category_id));
   }

   public function rowView(): string
   {
      return 'backend.vacancy.includes.row';
   }
}
