<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class User extends Authenticatable implements AuditableContract, MustVerifyEmail
{
    use Auditable, HasApiTokens, HasFactory, Notifiable, Uuid;

    const IMAGE_PATH = 'avatars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'google_id',
        'name',
        'username',
        'date_of_birth',
        'gender',
        'email',
        'password',
        'phone_number',
        'avatar',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function avatar(): string
    {
        return Storage::url($this->avatar);
    }

    public function isAdmin(): bool
    {
        return $this->role->name === 'admin';
    }

    public function isCustomer(): bool
    {
        return $this->role->name === 'customer';
    }

    public function isSeller(): bool
    {
        return $this->role->name === 'seller';
    }

    public function isWeaver(): bool
    {
        return $this->role->name === 'weaver';
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
