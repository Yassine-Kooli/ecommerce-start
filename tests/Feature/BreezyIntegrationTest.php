<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BreezyIntegrationTest extends TestCase
{
    /** @test */
    public function user_model_has_two_factor_authenticatable_trait()
    {
        $user = new User;
        $this->assertTrue(
            in_array('Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable', class_uses($user))
        );
    }

    /** @test */
    public function user_model_implements_has_avatar_interface()
    {
        $user = new User;
        $this->assertInstanceOf('Filament\Models\Contracts\HasAvatar', $user);
    }

    /** @test */
    public function user_model_implements_filament_user_interface()
    {
        $user = new User;
        $this->assertInstanceOf('Filament\Models\Contracts\FilamentUser', $user);
    }

    /** @test */
    public function user_avatar_url_returns_null_when_no_avatar()
    {
        $user = new User;
        $this->assertNull($user->getFilamentAvatarUrl());
    }

    /** @test */
    public function user_avatar_url_returns_storage_url_when_avatar_exists()
    {
        Storage::fake('public');

        $user = new User;
        $user->avatar_url = 'avatars/test-avatar.jpg';

        $expectedUrl = Storage::url('avatars/test-avatar.jpg');
        $this->assertEquals($expectedUrl, $user->getFilamentAvatarUrl());
    }

    /** @test */
    public function user_model_has_correct_fillable_fields()
    {
        $user = new User;
        $expectedFillable = [
            'name',
            'email',
            'avatar',
            'avatar_url',
            'password',
        ];

        $this->assertEquals($expectedFillable, $user->getFillable());
    }

    /** @test */
    public function user_model_has_hidden_fields()
    {
        $user = new User;
        $expectedHidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($expectedHidden, $user->getHidden());
    }

    /** @test */
    public function user_password_is_hashed_in_casts()
    {
        $user = new User;
        $casts = $user->getCasts();

        $this->assertArrayHasKey('password', $casts);
        $this->assertEquals('hashed', $casts['password']);
    }

    /** @test */
    public function user_email_verified_at_is_datetime_in_casts()
    {
        $user = new User;
        $casts = $user->getCasts();

        $this->assertArrayHasKey('email_verified_at', $casts);
        $this->assertEquals('datetime', $casts['email_verified_at']);
    }
}
