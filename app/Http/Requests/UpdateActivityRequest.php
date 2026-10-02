<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $activityId = $this->route('activity')->id;
        
        return [
        'category_id'   => 'required|exists:categories,id',
        'code'          => 'required|string|unique:activities,code,' . $activityId, 
        'title'         => 'required|string|max:255',
        'description'   => 'nullable|string',
        'activity_date' => 'required|date',
        'status'        => 'required|in:Planned,Ongoing,Completed,Cancelled',
        ];
    }
}
