<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name','title','department','email','phone','linkedin_url','bio',
        'photo_path','sort_order','is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // صورة افتراضية لو لم ترفع صورة
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo_path && \Storage::disk('public')->exists($this->photo_path)) {
            return asset('storage/'.$this->photo_path);
        }
        return asset('images/team/placeholder.png');
    }

    // سكوب الترتيب والتفعيل
    public function scopeActive($q){ return $q->where('is_active', true)->orderBy('sort_order'); }
}
