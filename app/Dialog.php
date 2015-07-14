<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $table = 'dialogs';

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
        return $this->belongsTo(User::class, 'from');
    }

    public function addressee()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
