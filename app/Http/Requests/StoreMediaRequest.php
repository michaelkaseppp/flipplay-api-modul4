<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPatch = $this->isMethod('PATCH') || $this->isMethod('PUT');
        $media = $this->route('media');
        $mediaId = is_object($media) ? $media->id : $media;

        return [
            'title' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($mediaId),
            ],
            'type' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:100'],
            'genre' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:255'],
            'release_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi',
            'title.unique' => 'Judul media sudah terdaftar di FlipPlay',
            'type.required' => 'Jenis media (anime/drama/manga/novel) wajib diisi',
            'genre.required' => 'Genre media wajib diisi',
            'release_year.integer' => 'Tahun rilis harus berupa angka',
        ];
    }
}
