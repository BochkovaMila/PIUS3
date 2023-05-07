<?php

namespace App\Domain\Doctors\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    protected $fillable = [
        'name','specialization',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
