<?php

namespace App\Http\Requests\Blog\Post;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Admin\AccessLevel;


class UpdateRequest extends FormRequest
{
    use AccessLevel;

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
        $rules = [
	    'title' => 'required',
	    'status' => 'required',
	    'content' => 'required',
        ];

	if (auth()->user()->getRoleLevel() > $this->post->getOwnerRoleLevel() || $this->post->owned_by == auth()->user()->id) {
	    $rules['access_level'] = 'required';
	    $rules['owned_by'] = 'required';
	}

	return $rules;
    }
}
