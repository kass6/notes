<?php

namespace App\Http\Requests;

use App\Models\Note;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email',
                function ($attribute, $value, $fail) {
                    if ($value === Auth::user()->email) {
                        $fail('Sending note to yourself? Really? :)');
                    }
                },
            ],
            'note' => [
                'required',
                'uuid',
                function ($attribute, $value, $fail) {
                    $note = Note::find($value);
                    if (!$note) {
                        $fail('Note not found!');
                    } elseif ($note->user_id !== Auth::id()) {
                        $fail('You not own this note!');
                    } elseif ($note->public != 0) {
                        $fail('You cant share public notes!');
                    }
                },
            ]
        ];
    }
}
