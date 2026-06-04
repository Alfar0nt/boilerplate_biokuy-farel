<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }

    public function test_theme_settings_can_be_updated_by_premium_users(): void
    {
        $user = User::factory()->create([
            'plan' => \App\Enums\PlanEnum::Pro,
        ]);

        $response = $this
            ->actingAs($user)
            ->withoutMiddleware()
            ->patch('/profile/theme', [
                'theme_settings' => [
                    'banner_gradient' => 'from-purple-500 to-indigo-700',
                    'card_style' => 'glassmorphism',
                    'font_family' => 'font-serif',
                    'bg_color' => '#faf5ff',
                    'show_membership' => 'false',
                ]
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertEquals('from-purple-500 to-indigo-700', $user->theme_settings['banner_gradient']);
        $this->assertEquals('glassmorphism', $user->theme_settings['card_style']);
        $this->assertEquals('font-serif', $user->theme_settings['font_family']);
        $this->assertEquals('#faf5ff', $user->theme_settings['bg_color']);
        $this->assertEquals('false', $user->theme_settings['show_membership']);
    }

    public function test_free_users_cannot_update_theme_settings(): void
    {
        $user = User::factory()->create([
            'plan' => \App\Enums\PlanEnum::Free,
        ]);

        $response = $this
            ->actingAs($user)
            ->withoutMiddleware()
            ->patch('/profile/theme', [
                'theme_settings' => [
                    'banner_gradient' => 'from-purple-500 to-indigo-700',
                    'card_style' => 'glassmorphism',
                    'font_family' => 'font-serif',
                    'bg_color' => '#faf5ff',
                    'show_membership' => 'false',
                ]
            ]);

        $response->assertRedirect('/profile');
        $this->assertNull($user->refresh()->theme_settings);
    }
}

