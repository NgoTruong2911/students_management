<?php

namespace App\Http\Requests\Users;

use App\Models\Subject;
use App\Rules\PointRule;
use Illuminate\Foundation\Http\FormRequest;

class PointRequest extends FormRequest
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
        $data = [];
        $data = [
            'subject_point.*.point' => 'required|numeric|min:0|max:10'
        ];
        return $data;
    }
    public function messages()
    {
        $messages = [];
        if(!empty($this->subject_point)){
            $subjects = Subject::all();
            foreach ($subjects as $subject) {
                foreach ($this->subject_point as $key => $id) {
                    if ($key == $subject->id) {
                        // dd($key.'.point');
                        $messages['subject_point.*'.$key.'.point' . '.required'] = 'The field label "Subject Title ' . $subject->name . '" is not null.';
                        $messages['subject_point.*'.$key.'.point' . '.numeric'] = 'The field label "Subject Title ' . $subject->name . '" is numeric.';
                        $messages['subject_point.*'.$key.'.point' . '.min'] = 'The field label "Subject Title ' . $subject->name . '"more than 0 .';
                        $messages['subject_point.*'.$key.'.point' . '.max'] = 'The field label "Subject Title ' . $subject->name . '" less than 10 max.';
                    }
                }
            }
        }
        return $messages;
    }
}
