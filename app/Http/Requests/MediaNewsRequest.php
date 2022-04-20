<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaNewsRequest extends FormRequest
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
         'category_id'   => 'required|numeric|exists:categories,id',
         'title'         => 'required|max:200',
         // 'source_link'   => 'required|max:255',
         'description'   => 'required',
         // 'image'         => 'required',
         'view_as'       => 'in:list,headline',
         'status'        => 'in:draft,published',
      ];
   }
}
