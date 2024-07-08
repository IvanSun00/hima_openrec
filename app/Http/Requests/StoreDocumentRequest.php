<?php

namespace App\Http\Requests;

use App\Http\Controllers\DocumentType;
use App\Rules\DocumentExistsRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;


class StoreDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $documentTypes = array_column(DocumentType::cases(), 'name');
        $list_image = ['Photo','Ktm'];
        $rules = [];
        foreach ($documentTypes as $documentType) {
            $allExcludeCurrentType = array_filter($documentTypes, function ($dt) use ($documentType) {
                return $dt !== $documentType;
            });

            $rules[strtolower($documentType)] = [
                'required_without_all:' . strtolower(join(',', $allExcludeCurrentType)),
                new DocumentExistsRule(),
                in_array($documentType, $list_image) ? File::types(['jpg', 'jpeg', 'png'])->max(5120) : File::types(['pdf'])->max(5120),
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $documentTypes = DocumentType::cases();
        $messages = [];
        foreach ($documentTypes as $documentType) {
            $messages[strtolower($documentType->name) . '.required_without_all'] = $documentType->value . ' file is required';
            $messages[strtolower($documentType->name) . '.image'] = $documentType->value . ' file must be an image';
            $messages[strtolower($documentType->name) . '.max'] = $documentType->value . ' file size must be less than 5mb';
            $messages[strtolower($documentType->name) . '.mimes'] = in_array($documentType->name, ['Photo','Ktm'])? $documentType->value . ' file must be a file of type: jpg, png' : $documentType->value . ' file must be a file of type:  pdf';
        }

        return $messages;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $exception = $validator->getException();

        throw (new $exception($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
