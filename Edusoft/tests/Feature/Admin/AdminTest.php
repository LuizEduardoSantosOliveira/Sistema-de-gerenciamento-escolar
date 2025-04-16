<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_AdminDashboard_can_be_rendered(): void
{
    $admin = User::factory()->state(['user_type' => 'admin'])->create();
    
    $this->actingAs($admin);
    
    $response = $this->get('/Admin/AdminDashboard');
    
    $response->assertStatus(200);
}

public function test_CalendarManagment_can_be_rendered(): void
{
    $admin = User::factory()->state(['user_type' => 'admin'])->create();
    
    $this->actingAs($admin);
    
    $response = $this->get('/Admin/CalendarManagment');
    
    $response->assertStatus(200);

    
}

public function test_GradeManagment_can_be_rendered(): void
{
    $admin = User::factory()->state(['user_type' => 'admin'])->create();
    
    $this->actingAs($admin);
    
    $response = $this->get('/Admin/GradeManagment');
    
    $response->assertStatus(200);
}

public function test_RequirementManagment_can_be_rendered(): void
{
    $admin = User::factory()->state(['user_type' => 'admin'])->create();
    
    $this->actingAs($admin);
    
    $response = $this->get('/Admin/RequirementManagment');
    
    $response->assertStatus(200);
}

public function test_UserManagment_can_be_rendered(): void
{
    $admin = User::factory()->state(['user_type' => 'admin'])->create();
    
    $this->actingAs($admin);
    
    $response = $this->get('/Admin/UserManagment');
    
    $response->assertStatus(200);
}

}
