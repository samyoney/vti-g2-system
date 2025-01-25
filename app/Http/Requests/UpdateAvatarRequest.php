<?php

namespace App\Http\Requests;

class UpdateAvatarRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'avatar' => 'required|image',
        ];
    }
}
