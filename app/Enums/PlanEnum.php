<?php

namespace App\Enums;

enum PlanEnum: string
{
    case Free = 'free';
    case Student = 'student';
    case Pro = 'pro';

    /**
     * Get the display label for the plan.
     */
    public function label(): string
    {
        return match ($this) {
            self::Free => 'Free',
            self::Student => 'Student',
            self::Pro => 'Pro',
        };
    }

    /**
     * Get the maximum number of links allowed for the plan.
     */
    public function linkLimit(): int
    {
        return match ($this) {
            self::Free => 5,
            self::Student => 15,
            self::Pro => PHP_INT_MAX,
        };
    }

    /**
     * Get the monthly price in Rupiah.
     */
    public function price(): int
    {
        return match ($this) {
            self::Free => 0,
            self::Student => 29_000,
            self::Pro => 79_000,
        };
    }

    /**
     * Get formatted price string.
     */
    public function formattedPrice(): string
    {
        return match ($this) {
            self::Free => 'Gratis',
            default => 'Rp ' . number_format($this->price(), 0, ',', '.') . '/bln',
        };
    }

    /**
     * Check if the plan supports custom themes.
     */
    public function hasCustomTheme(): bool
    {
        return match ($this) {
            self::Free => false,
            self::Student, self::Pro => true,
        };
    }

    /**
     * Get the analytics level for the plan.
     */
    public function analyticsLevel(): string
    {
        return match ($this) {
            self::Free => 'basic',
            self::Student => 'standard',
            self::Pro => 'advanced',
        };
    }

    /**
     * Get the CSS badge class for the plan.
     */
    public function badgeClass(): string
    {
        return match ($this) {
            self::Free => 'badge-free',
            self::Student => 'badge-student',
            self::Pro => 'badge-pro',
        };
    }
}
