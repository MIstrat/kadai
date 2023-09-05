<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
use App\Models\Site; 
use App\Models\User;
use App\Rules\HasPermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
    public function rules(FormRequest $request)
    {
        //  dd($request);
        
        // $validator = Validator::make($request->all(), [
        //     'sites.*.site_name' => Rule::forEach(function (string|null $value, string $attribute) {
        //         return [
        //             Rule::exists(Company::class, 'id'),
        //             new HasPermission('manage-company', $value),
        //         ];
        //     }),
        // ]);
        
        return [
            'post.email' => 'required|email|max:200',
            'post.address' => 'required|string|max:200',
            'post.tel' => 'required|digits_between:10,15',
            'post.creditCardType' => 'nullable|string|max:100',
            'post.creditCardNumber' => 'nullable|digits_between:14,16',
            'sites.site_name' => 'required|string|max:100',
            'sites.site_url' => 'required|url|max:100',
            // 'sites.*.site_name' => 'max:100',
            // 'sites.*.site_url' => 'nullable|url|max:100',
            // 'newSites.*.site_name' => 'url|max:100',
            // 'newSites.*.site_url' => 'nullable|url|max:100',
            
        ];
        
        //  foreach($request['sites'] as $key){
             
        //     $request->validate([
        //         'sites.*.site_name' => 'required|string|max:100',
        //         'sites.*.site_url' => 'required|url|max:100',
        //         'newSites.*.site_name' => 'required|string|max:100',
        //         'newSites.*.site_url' => 'required|url|max:100',
        //      ]);
        // }
    }
    
     public function messages()
    {
          return [
            'post.email.required' => 'メールアドレスを入力してください',
            'post.email.email' => 'メールアドレス形式で入力してください',
            'post.email.max:200' => '200文字以内で入力してください',
            'post.address.required'  => '住所を入力してください',
            'post.address.max:200'  => '200文字以内で入力してください',
            'post.tel.required'  => '電話番号を入力してください',
            'post.tel.digits_between:10,15'  => '電話番号は10～15桁の数字で入力してください',
            'post.creditcardNumber.digits_between:14,16'  => '14～16桁の数字で入力してください',
            'sites.site_name.required'  => 'サイト名を入力してください',
            'sites.site_url.required'  => 'サイトURLを入力してください',
            'sites.site_url.url'  => 'URL形式で入力してください',
            // 'sites.*.site_url.url'  => 'URL形式で入力してください',
            // 'newSites.*.site_url.url'  => 'URL形式で入力してください',
            
          ];
    }
    
}
