<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() && Auth::user()->email === config('mail.personal.email');
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'entry_categories_id' => data_get($this->category, 'id'),
            'user_id' => Auth::user()->id,
            'is_draft' => true,
        ]);
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['nullable', 'max:255'],
            'entry_categories_id' => ['required', Rule::exists('entry_categories', 'id')],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'content' => ['required'],
            'is_draft' => ['boolean'],
        ];
    }
}
