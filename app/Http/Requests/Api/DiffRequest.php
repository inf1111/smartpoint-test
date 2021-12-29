<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\AlphaNumericSpace;
use Illuminate\Foundation\Http\FormRequest;

class DiffRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'diffArr' => ['required', 'array', 'min:1'],
            'diffArr.*' => ['required', 'string', 'distinct', 'min:3', new AlphaNumericSpace()],
        ];
    }

}
