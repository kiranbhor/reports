<?php

namespace Modules\Reports\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateReportModuleRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:reports__reportmodules,name',
            'order' => 'required|unique:reports__reportmodules,order',
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
            'order.unique' => 'Order Already Exist',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
