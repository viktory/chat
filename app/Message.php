<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    /**
     * Get the validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from' => 'required|exists:users,id',
            'dialog_id' => 'required|exists:dialogs,id',
            'text' => 'required',
        ];
    }

    public function validate()
    {
        $validator = \Validator::make(
            $this->toArray(),
            $this->rules()
        );

        return $validator->passes();
    }


    /**
     * @param $query
     * @param $dialogId
     *
     * @return mixed
     */
    public function scopeByDialog($query, $dialogId)
    {
        return $query->where('dialog_id', $dialogId);
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    public function dialog()
    {
        return $this->belongsTo(Dialog::class, 'dialog_id');
    }
}
