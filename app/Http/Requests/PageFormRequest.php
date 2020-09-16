<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = optional($this->route('page'))->id;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|unique:pages,slug,' . $id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указан заголовок страницы',
            'name.max'      => 'Максимальное значение :max символов',

            'slug.unique' => 'Слаг уже занят. Оставьте пустым, чтобы сгенерировать автоматически'
        ];
    }

    protected function prepareForValidation()
    {
//        dd($this->route('page')->id);

        $slug = $this->input('slug') ? Str::slug($this->input('slug')) : null;

        $this->merge(compact('slug'));
    }
}
