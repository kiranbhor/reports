<?php

namespace Modules\Reports\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateReportMasterRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:reports__reportmasters,name,'.$this->old_name.',name|max:255',
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
