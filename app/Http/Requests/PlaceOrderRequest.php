<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PlaceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check())
        {
            return false;
        }
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
            'mpesaPhonenumber' => ['required', 'digits:10'],
            'payment_method' => ['required', 'in:mpesa,credit'],
            'first_name' => ['required', 'max:20', 'min:5'],
            'last_name' => ['required', 'max:20', 'min:5'],
            'address' => ['required', 'max:20'],
            'post_code' => ['required', 'max:20'],
            'country' => ['required', 'max:20'],
            'notes' => ['required', 'max:20'],
            'city' => ['required', 'max:20']
        ];
    }
}
