<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    
    public function getByLimit(int $limit_count = 1)
    {
        return $this->orderBy('id')->limit($limit_count)->get();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post.email' => 'required|string|max:100',
                'post.address' => 'required|string|max:200',
                'post.tel' => 'required|string|max:100',
            //
        ];
    }
}
