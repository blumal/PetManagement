<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoCrear extends FormRequest
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
            'nombre_art'=>'required|string|max:255',
            'descripcion_art'=>'required|string|max:255',
            'precio_art'=>'required|int',
            'codigobarras_art'=>'required|int|min:4|max:13',
            'foto'=>'required|mimes:jpg,png,jpeg,webp,svg'
        ];
    }
}
