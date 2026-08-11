<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    protected $errorBag = 'contact';

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(collect($this->only([
            'name',
            'email',
            'organization',
            'category',
            'message',
        ]))->map(fn ($value) => is_string($value) ? trim($value) : $value)->all());
    }

    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'min:2', 'max:100'],
            'email' => ['bail', 'required', 'string', 'email:rfc', 'max:254'],
            'organization' => ['nullable', 'string', 'max:150'],
            'category' => ['bail', 'required', 'string', Rule::in(array_keys(config('contact.categories')))],
            'message' => ['bail', 'required', 'string', 'min:20', 'max:5000'],
            'consent' => ['accepted'],
            'website' => ['nullable', 'string', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Indiquez votre nom.',
            'name.min' => 'Le nom doit contenir au moins 2 caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 100 caractères.',
            'email.required' => 'Indiquez votre adresse e-mail.',
            'email.email' => 'Indiquez une adresse e-mail valide.',
            'email.max' => 'L’adresse e-mail est trop longue.',
            'organization.max' => 'L’organisation ne peut pas dépasser 150 caractères.',
            'category.required' => 'Sélectionnez la catégorie de votre besoin.',
            'category.in' => 'Sélectionnez une catégorie proposée.',
            'message.required' => 'Décrivez votre besoin.',
            'message.min' => 'Le message doit contenir au moins 20 caractères.',
            'message.max' => 'Le message ne peut pas dépasser 5 000 caractères.',
            'consent.accepted' => 'Votre consentement est nécessaire pour envoyer la demande.',
            'website.max' => 'La demande n’a pas pu être envoyée. Vérifiez le formulaire et réessayez.',
        ];
    }
}
