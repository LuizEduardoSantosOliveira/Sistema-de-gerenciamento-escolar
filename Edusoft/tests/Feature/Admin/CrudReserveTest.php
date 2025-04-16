<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reserve;
use App\Models\Ambient;

class ReserveCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that non-admin users cannot access reserve management
     */
    public function test_non_admin_can_not_view_list_of_reserves(): void
    {
        
        $student = User::factory()->state(['user_type' => 'student'])->create();

        
        $response = $this->post('/login', [
            'email' => $student->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->actingAs($student);

       
        $response = $this->get('/Admin/ReserveManagment');
        $response->assertStatus(302); 

       
        $this->post('/logout');

        
        $teacher = User::factory()->state(['user_type' => 'teacher'])->create();
        $response = $this->post('/login', [
            'email' => $teacher->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->actingAs($teacher);

      
        $response = $this->get('/Admin/ReserveManagment');
        $response->assertStatus(302); 
    }

    
    public function test_admin_can_create_reserve(): void
    {
       
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);
        
        
        $ambient = Ambient::factory()->create();

        
        $reserveData = [
            'reservationer' => 'John Doe',
            'user_id' => $user->id,
            'reservation_datetime' => '2025-04-20 14:00:00',
            'ambient_id' => $ambient->id,
        ];

        
        $response = $this->post(route('reserves.store'), $reserveData);

        
        $response->assertRedirect(route('reserves.index'));

        
        $this->assertDatabaseHas('reserves', [
            'reservationer' => 'John Doe',
            'user_id' => $user->id,
            'ambient_id' => $ambient->id,
        ]);
    }

   
    public function test_admin_can_update_reserve(): void
    {
        
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);
        
        
        $ambient1 = Ambient::factory()->create();
        $ambient2 = Ambient::factory()->create();

        
        $reserve = Reserve::factory()->create([
            'reservationer' => 'Original Name',
            'user_id' => $user->id,
            'reservation_datetime' => '2025-04-20 14:00:00',
            'ambient_id' => $ambient1->id,
        ]);

        $updatedReserveData = [
            'reservationer' => 'Updated Name',
            'user_id' => $user->id,
            'reservation_datetime' => '2025-04-21 15:00:00',
            'ambient_id' => $ambient2->id,
        ];

        
        $response = $this->put(route('reserves.update', $reserve->id), $updatedReserveData);

        
        $response->assertRedirect(route('reserves.index'));

        
        $this->assertDatabaseHas('reserves', [
            'id' => $reserve->id,
            'reservationer' => 'Updated Name',
            'reservation_datetime' => '2025-04-21 15:00:00',
            'ambient_id' => $ambient2->id,
        ]);

        
        $this->assertDatabaseMissing('reserves', [
            'id' => $reserve->id,
            'reservationer' => 'Original Name',
            'ambient_id' => $ambient1->id,
        ]);
    }

   
    public function test_admin_can_delete_reserve(): void
    {
        
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);
        
        
        $ambient = Ambient::factory()->create();

        
        $reserve = Reserve::factory()->create([
            'reservationer' => 'To Be Deleted',
            'user_id' => $user->id,
            'reservation_datetime' => '2025-04-20 14:00:00',
            'ambient_id' => $ambient->id,
        ]);

        
        $response = $this->delete(route('reserves.destroy', $reserve->id));

       
        $response->assertRedirect(route('reserves.index'));

        
        $this->assertDatabaseMissing('reserves', [
            'id' => $reserve->id,
        ]);
    }

  
    public function test_admin_can_read_reserves(): void
    {
        
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);

       
        $response = $this->get(route('reserves.index'));

    
        $response->assertStatus(200);
    }
}