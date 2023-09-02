<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
// use App\Models\Site; 
use App\Models\User;

class EditRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     
    
    public function authorize()
    {
        return true;
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
            'post.tel' => 'required|string|max:15',
            'post.creditcardType' => 'required|string|max:100',
            'post.creditcardNumber' => 'required|string|max:16',
            // 'site.site_name' => 'required|string|max:100',
            // 'site.site_url' => 'required|string|max:100',
            //
        ];
    }
}
