<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{

    public $fillable = ['title', 'desc', 'file', 'user_id', 'privacy'];

    use HasFactory;

    // Relationship with user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Filter
    public function scopeFilter($query, array $filters) {
        
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('desc', 'like', '%' . request('search') . '%');
            
        } else if($filters['user'] ?? false) {
            $query->where('user_id', 'like', '%' . request('user') . '%');
        } 
        else {
            $query->where('privacy', 'public');
        }

    }
    
}
