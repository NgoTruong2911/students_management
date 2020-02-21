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
        // collect($this->subject_point);
        // dd(request()->all());
        // dd($this);
        $data = [];
        $data = [
            'subject_point.*.point' => 'required|numeric|min:0|max:10'
        ];
        return $data;
    }
    // public function messages()
    // {
    //     $messages = [];
    //     $subjects = Subject::all();
    //     foreach ($subjects as $subject) {
    //         if (['subject_point.*'] == $subject->id) {
    //             $messages['subject_point.*.point' . '.required'] = 'The field label "Subject Title ' . $subject->name . '" is required.';
    //             $messages['subject_point.*.point' . '.numeric'] = 'The field label "Subject Title ' . $subject->name . '" is number not characters or words.';
    //             $messages['subject_point.*.point' . '.min'] = 'The field label "Subject Title ' . $subject->name . '" must be less than :min subject->nameue.';
    //             $messages['subject_point.*.point' . '.max'] = 'The field label "Subject Title ' . $subject->name . '" must be more than :max value.';
    //         }
    //     }
    //     // dd($messages);
    //     return $messages;
    // }
}
