<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'book_id',
        'rental_length',
        'penalty',
        'status',
        'created_at',
        'updated_at',
    ];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
