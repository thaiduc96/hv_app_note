<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'receiver_address' => 'required',
            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            'note' => 'nullable',
            'device_token' => 'required',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id,deleted_at,NULL',
            'products.*.quantity' => 'required|numeric|min:0|max:99999999999',
            'delivery_time_from' => 'nullable|date_format:H:i',
            'delivery_time_to' => 'nullable|date_format:H:i|after:delivery_time_from',
        ];
    }
}
