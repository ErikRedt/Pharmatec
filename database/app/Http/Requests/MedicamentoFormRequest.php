<?php

namespace Pharmatec\Http\Requests;

use Pharmatec\Http\Requests\Request;

class MedicamentoFormRequest extends Request
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
            //
          
          'nombre'=>'required|max:50',
          'descripcion'=>'required|max:100',
          'idpresentacion'=>'required',        
          'stock'=>'required|numeric',
          'precio_compra'=>'required|numeric',
          'precio_venta'=>'required|numeric',
          'imagen'=>'mimes:jpeg,png,bmp'
          
        ];
    }
}
