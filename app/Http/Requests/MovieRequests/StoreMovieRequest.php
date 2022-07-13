<?php

namespace App\Http\Requests\MovieRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'logo' => 'sometimes',
            'trailer' => 'sometimes',
            'release_date' => ['required', 'date'],
            'production_date' => ['required', 'date'],
        ];
    }
}
