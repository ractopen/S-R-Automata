<?php

use App\Models\User;
use App\Mail\SendRegistrationOtpMail;
use App\Mail\SendLoginOtpMail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Mail::fake();
});

test('registration sends OTP and redirects to verification page', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertRedirect(route('register.otp.verify'));
    $this->assertGuest();
    
    // Assert email was sent
    Mail::assertSent(SendRegistrationOtpMail::class);

    // Assert user exists but not verified
    $user = User::where('email', 'test@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->email_verified_at)->toBeNull();
    expect(session('register.id'))->toBe($user->id);
});

test('verifying correct registration OTP activates account and logs user in', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('Password123!'),
    ]);
    
    $otp = '123456';
    $user->otp = Hash::make($otp);
    $user->otp_expires_at = now()->addMinutes(15);
    $user->save();

    session(['register.id' => $user->id]);

    $response = $this->post('/register/verify-otp', [
        'otp' => $otp,
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);

    $user->refresh();
    expect($user->email_verified_at)->not->toBeNull();
    expect($user->otp)->toBeNull();
});

test('login sends OTP and redirects to login verify page', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('Password123!'),
    ]);

    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'Password123!',
    ]);

    $response->assertRedirect(route('login.otp.verify'));
    $this->assertGuest();
    Mail::assertSent(SendLoginOtpMail::class);
});

test('forgot password OTP cannot reset to current password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password123!'),
    ]);

    $otp = '123456';
    $user->otp = Hash::make($otp);
    $user->otp_expires_at = now()->addMinutes(15);
    $user->save();

    $response = $this->post('/verify-otp', [
        'email' => $user->email,
        'otp' => $otp,
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertSessionHasErrors(['password']);
    
    // Check that password did not change
    $user->refresh();
    expect(Hash::check('Password123!', $user->password))->toBeTrue();
});
