<?php namespace App\Modules\Organization\Requests\Admin;

use App\Http\Requests\Request;

class OrganizationRequest extends Request {

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
