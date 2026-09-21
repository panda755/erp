<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'address', 'email', 'phone_number', 'logo'])]
class Company extends Model
{
    //
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
