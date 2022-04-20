<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
         'date_from'       => 'required',
         'date_end'       => 'required',
         'location'          => 'required|max:200',
         'host'              => 'required|max:200',
         'published'         => 'in:draft,published',
         'published_start'   => 'required',
         'published_end'   => 'required',
         // 'source_link'   => 'required|max:255',
      ];
   }
}
