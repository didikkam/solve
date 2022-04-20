<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
         'name'              => 'required|max:255',
         'email'             => 'required|unique:users,email|email',
         'password'          => 'required',
         'type'              => 'required|in:alumni,dosen,mahasiswa,umum',
         'majors_id'         => 'required|exists:majors,id',
         'no_hp'             => 'required|numeric|digits_between:11,13|unique:users,no_hp',
         'year_entry'        => 'numeric|digits:4',
         'year_out'          => 'numeric|digits:4',
         'address'           => 'required',
         'location'          => 'required',
         'country_id'        => 'required|exists:geo_countries,id',
         'province_id'       => 'exists:geo_provinces,id',
         'city_id'           => 'exists:geo_cities,id',
      ];
   }
}
