<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Statut extends Model
{
    public function book(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
