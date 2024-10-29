<?php

use Illuminate\Support\Str;

if (!function_exists('GetAllDataValidation')) {
    function GetAllDataValidation($moduleName, $fields)
    {


        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }



        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\Management\\{$moduleName}\\Validations;

            use Illuminate\Contracts\Validation\Validator;
            use Illuminate\Foundation\Http\FormRequest;
            use Illuminate\Http\Exceptions\HttpResponseException;
            use Illuminate\Validation\Rule;

            class GetAllValidation extends FormRequest
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
                public function validateError(\$data)
                {
                    \$errorPayload =  \$data->getMessages();
                    return response(['status' => 'validation_error', 'errors' => \$errorPayload], 422);
                }

                protected function failedValidation(Validator \$validator)
                {
                    throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    if (\$this->wantsJson() || \$this->ajax()) {
                        throw new HttpResponseException(\$this->validateError(\$validator->errors()));
                    }
                    parent::failedValidation(\$validator);
                }

                /**
                 * Get the validation rules that apply to the request.
                 *
                 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
                 */
                public function rules(): array
                {
                    return [
                        'limit' => 'required|sometimes',
                        'page' => 'required|sometimes',
                        'fields' => 'required|sometimes',
                        'sort_by_col' => 'required|sometimes',
                        'sort_type' => 'required|sometimes',
                        'status' => 'required|sometimes',

                    ];
                }
            }
            EOD;

        return $content;
    }
}
