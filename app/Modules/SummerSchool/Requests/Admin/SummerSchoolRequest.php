<?php namespace App\Modules\SummerSchool\Requests\Admin;

use App\Http\Requests\Request;

class SummerSchoolRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required',
            'language_id' => 'required|integer',
            'title' => 'required|min:3'
        ];
    }
}
