<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\IsAdminEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;
use Teguh02\IndonesiaTerritoryForms\Models\SubDistrict;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable;
    use HasRoles;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'is_admin',
        'subdistrict_id'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => IsAdminEnum::class,
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // str_ends_with($this->email, '@larament.test');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    public function instansi(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class, 'subdistrict_id', 'id');
    }
}
