<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $table = 'family_members';

    protected $fillable = [
        'head_of_family_id',
        'user_id',
        'profile_picture',
        'identity_number',
        'gender',
        'date_of_birth',
        'phone_number',
        'occupation',
        'marital_status',
        'relation',
    ];

    // 1 Family Member <-> 1 Head of Family
    public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }

    // 1 Family Member <-> 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
