<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'department_id',
    'position_id',
    'address',
    'place_of_birth',
    'date_of_birth',
    'gender',
    'religion',
    'phone_number',
    'salary',
    'start_date',
    'end_date',
    'status',
    'image',
])]
class Employee extends Model
{
    //
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'start_date'    => 'date',
            'end_date'      => 'date',
            'salary'        => 'integer',
        ];
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
