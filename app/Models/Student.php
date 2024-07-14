<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'identification_number',
        'phone_number',
        'study_program',
        'student_class',
    ];
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
