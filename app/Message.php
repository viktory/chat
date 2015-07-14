<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

/**
 * Class Message
 *
 * It is possible to use table dialog with 3 fields: id, sender, receiver.
 * And in this case fields "from" and "to" should be removed from table "messages" and field "dialog_id" should be added as a foreign key.
 * But I decided that this structure is too complicated (overloaded) for such small application.
 *
 * Also data "from" and "to" could be stored in the one field (with type "array")
 *
 * @package App
 */
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
            'to' => 'required|exists:users,id|different:from',
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
     * @param $from
     * @param $to
     *
     * @return mixed
     */
    public function scopeByUsers($query, $from, $to)
    {
        return $query->where(function ($tmpQuery) use ($from, $to) {
            $tmpQuery->where('from', $from)
                ->where('to', $to);
        })->orWhere(function ($tmpQuery) use ($from, $to) {
            $tmpQuery->where('from', $to)
                ->where('to', $from);
        });
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}
