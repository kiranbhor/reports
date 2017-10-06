<?php

namespace Modules\Reports\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateReportMasterRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:reports__reportmasters,name',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name',
            'name.unique' => 'Name Already Exuist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
