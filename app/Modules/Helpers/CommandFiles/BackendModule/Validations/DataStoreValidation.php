<?php

use Illuminate\Support\Str;

if (!function_exists('DataStoreValidation')) {
    function DataStoreValidation($moduleName, $fields)
    {


        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $formatField = [];
        if (count($fields)) {
            foreach ($fields as $field) {
                $formatField[] = [
                    $field[0] => 'required'
                ];
            }
        }
        // dd($formatField);

        $content = <<<"EOD"
            <?php

            namespace App\\Modules\\Management\\{$moduleName}\\Validations;

            use Illuminate\Contracts\Validation\Validator;
            use Illuminate\Foundation\Http\FormRequest;
            use Illuminate\Http\Exceptions\HttpResponseException;
            use Illuminate\Validation\Rule;

            class DataStoreValidation extends FormRequest
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

            EOD;

        // Now, let's dynamically add rules from $formatField
        if (count($formatField)) {
            foreach ($formatField as $fieldName => $rule) {
                if (is_array($rule)) {
                    foreach ($rule as $field => $validation) {
                        $content .= "            '$field' => '$validation | sometimes',\n";
                    }
                }
            }
        }
        $content .= <<<EOD
                        'status' => ['sometimes', Rule::in(['active', 'inactive'])],
                    ];
                }
            }
            EOD;

        return $content;
    }
}
