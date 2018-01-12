<?php

namespace BtyBugHook\Membership\Http\Requests;

use Btybug\btybug\Http\Requests\Request;

class MembershipStatusCreateRequest extends Request
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
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return [
                'title' => 'required'
            ];
        }
        return [];
    }
}