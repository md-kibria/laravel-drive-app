<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    // Fillable 
    public $fillable = ['user_id', 'doc_id'];

    // filter
    public function scopeFilter($query, array $filters) {
        if($filters['user'] ?? false) {
            dd($filters['user']);
            $query->where('user_id', request('user'));
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function doc() {
        return $this->belongsTo(Doc::class);
    }
}
