<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_and_are_redirected_correctly()
    {
        $student = User::factory()->state(['user_type' => 'student'])->create();
        
        $response = $this->post('/login', [
            'email' => $student->email,
            'password' => 'password',
        ]);
        
        $this->assertAuthenticated();
        $response->assertRedirect(route('studentdashboard', absolute: false));
        
        $this->post('/logout');
        
        $teacher = User::factory()->state(['user_type' => 'teacher'])->create();
        
        $response = $this->post('/login', [
            'email' => $teacher->email,
            'password' => 'password',
        ]);
        
        $this->assertAuthenticated();
        $response->assertRedirect(route('teacherdashboard', absolute: false));
        
        $this->post('/logout');

        $admin = User::factory()->state(['user_type' => 'admin'])->create();
        
        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        
        $this->assertAuthenticated();
        $response->assertRedirect(route('admindashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
