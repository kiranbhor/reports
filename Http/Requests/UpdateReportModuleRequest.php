<?php

namespace Modules\Reports\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateReportModuleRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:reports__reportmodules,name,'.$this->old_name.',name|max:255',
            'order' => 'required',
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
            'order.required' => 'Please Enter Order',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
