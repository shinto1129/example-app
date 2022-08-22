<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
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
     * @return array
     */
    public function rules(Request $request)
    {
        /**
         * 編集画面のバリデーションチェック
         */
        return [
            'name'   => ['required', 'string', 'max:255'],
            'adress' => ['required', 'string', 'max:255'],
            'tel'    => ['required', 'string', 'max:20'],
            'email'  => ['required',
                        // 重複チェック。Rule::unique('テーブル名')->ignore(主キー, '主キーのカラム名')
                        Rule::unique('users')->ignore($request->user_id, 'id'),
                        ],
        ];
    }
}
