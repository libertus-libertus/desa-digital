<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAssistance extends Model
{
    use HasFactory, UUID, SoftDeletes;
    
    protected $table = 'social_assistances';

    protected $fillable = [
        'thumbnail',
        'name',
        'category',
        'amount',
        'provider', // penyedia bantuan sosial
        'description',
        'is_available',
    ];

    // 1 bantuan sosial memiliki banyak penerima
    public function socialAssistanceRecipients()
    {
        return $this->hasMany(SocialAssistanceRecipient::class);
    }
}
