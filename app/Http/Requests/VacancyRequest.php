<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      return [
         'category_id'       => 'required|numeric|exists:categories,id',
         'name'              => 'required|max:200',
         'description'       => 'required',
         'address'          => 'required|max:200',
         'company'          => 'required|max:200',
         'position'          => 'required|max:200',
         'type'            => 'required|in:full-time,part-time',
         'published'         => 'in:draft,published',
         'published_start'   => 'required',
         'published_end'   => 'required',
         // 'source_link'     => 'required|max:255',
      ];
   }
}
