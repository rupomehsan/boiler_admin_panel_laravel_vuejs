<?php

namespace App\Modules\BlogManagement\Blog\Actions;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class Validation extends FormRequest
{
    /**
     * Determine if the  is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * validateError to make this request.
     */
    public function validateError($data)
    {
        $errorPayload =  $data->getMessages();
        return response(['status' => 'validation_error', 'errors' => $errorPayload], 422);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'tags' => 'sometimes',
            'publish_date' => 'sometimes',
            'writer' => 'sometimes',
            'meta_title' => 'sometimes',
            'meta_description' => 'sometimes',
            'meta_keywords' => 'sometimes',
            'thumbnail_image' => 'sometimes',
            'image' => 'sometimes',
            'blog_type' => 'sometimes',
            'url' => 'sometimes',
            'privecy_status' => ['sometimes', Rule::in(['public', 'private'])],
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validateError($validator->errors()));
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException($this->validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }
}
