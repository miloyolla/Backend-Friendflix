<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\User;

class UserRequest extends FormRequest
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
      if($this->isMethod('post')){
        return [
          'name' => 'required|alpha',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|integer',
          'date_birth' => 'string|Data',
          'user_name' => 'required|string|unique:users,user_name'
        ];
      }
    }

    protected function failedValidation(Validator $validator){
      throw new
      HttpResponseException(response()->json($validator->errors(), 422));
    }


    public function messages(){
      return[
        'name.alpha' => 'O nome deve consistir apenas de caracteres alfabeticos.',
        'email.email' => 'Insira um email valido',
        'password.integer' => 'A senha deve conter somente numeros',
        'date_birth.string' => 'Insira uma data valida',
        'user_name.string' => 'Insira um nome de usuario valido'
      ];
    }
}
