<?php

namespace App\Models;

use App\Enums\PlanEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio',
        'avatar_public_id',
        'avatar_url',
        'theme',
        'theme_settings',
        'plan',
        'custom_url',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'plan' => PlanEnum::class,
            'is_active' => 'boolean',
            'theme_settings' => 'array',
        ];
    }

    // =========================================================
    // RELATIONSHIPS
    // =========================================================

    /**
     * Get all links for the user.
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Get all subscriptions for the user.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the currently active subscription.
     */
    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->latestOfMany('started_at');
    }

    // =========================================================
    // METHODS
    // =========================================================

    /**
     * Check if the user can add a new link based on their plan limit.
     */
    public function canAddLink(): bool
    {
        return $this->links()->count() < $this->getLinkLimit();
    }

    /**
     * Get the active plan name.
     */
    public function getActivePlan(): PlanEnum
    {
        return $this->plan ?? PlanEnum::Free;
    }

    /**
     * Get the link limit based on the current plan.
     */
    public function getLinkLimit(): int
    {
        return $this->getActivePlan()->linkLimit();
    }

    // =========================================================
    // ACCESSORS
    // =========================================================

    /**
     * Get the user's avatar URL, falling back to a default.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function (): string {
            if ($this->attributes['avatar_url'] ?? null) {
                return $this->attributes['avatar_url'];
            }

            $name = urlencode($this->name ?? 'User');

            return "https://ui-avatars.com/api/?name={$name}&background=0D9488&color=fff&bold=true&format=svg";
        });
    }

    /**
     * Get the full public URL for this user's profile page.
     */
    protected function publicUrl(): Attribute
    {
        return Attribute::get(function (): string {
            $identifier = $this->custom_url ?? $this->username ?? $this->id;
            return url("/{$identifier}");
        });
    }
}
