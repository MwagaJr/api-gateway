<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedRequest extends Model
{
    //

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

}
