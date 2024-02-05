<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\séèêàùûôëïüÿçÉÈÊÀÙÛÔËÏÜŸÇ\-]*$/'],
            'date' => 'required|date',
            'time' => 'required|date_format:H:i', //H=format 24 heures (00-23).  && i = les minutes (00-59).
            'location' =>  ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\séèêàùûôëïüÿçÉÈÊÀÙÛÔËÏÜŸÇ\-]*$/'],
            'location_description' => 'required|string',
            'min_people' => 'required|integer|min:1',
            'max_people' => 'required|integer|min:' . $this->input('min_people'), // Max doit être au moins égal à min.
            'type' => 'required|string|in:outdoor,indoor',
            'people_type' => 'required|string|in:between_parents,parents_children',
        ];
    }
}
