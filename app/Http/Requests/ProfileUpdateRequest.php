<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender' => ['string', 'max:255'],
            'renterIC' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'studNo' => ['string', 'max:255'],
            'licenseNo' => ['string', 'max:255'],
            'phoneNo' => ['string', 'max:255'], 
            'icImg' => ['image', 'max:2048'], // Assuming icImg is an image upload
            'icImg2' => ['image', 'max:2048'],
            'licImg' => ['image', 'max:2048'],
            'licImg2' => ['image', 'max:2048'],
        ];
    }
}
