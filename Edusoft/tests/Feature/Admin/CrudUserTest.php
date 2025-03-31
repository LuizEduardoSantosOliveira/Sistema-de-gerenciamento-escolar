<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CrudUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_non_admin_can_not_view_list_of_users(): void
    {

        $student = User::factory()->state(['user_type' => 'student'])->create();

        $response = $this->post('/login', [
            'email' => $student->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->actingAs($student);

        $response = $this->get('/Admin/UserManagment');

        $response->assertStatus(302);


        $this->post('/logout');

        $teacher = User::factory()->state(['user_type' => 'teacher'])->create();

        $response = $this->post('/login', [
            'email' => $teacher->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $this->actingAs($teacher);

        $response = $this->get('/Admin/UserManagment');

        $response->assertStatus(302);
    }

    public function test_admin_can_create_user(): void
    {
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);

        $userData = [
            'name' => 'Novo Usuário',
            'email' => 'novo@exemplo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'cpf' => '12345678901',
            'cep' => '12345678',
            'telephone' => '123456789',
            'user_type' => 'teacher'
        ];


        $response = $this->post(route('users.store'), $userData);

        $response->assertRedirect(route(("users.index")));

        $this->assertDatabaseHas('users', [
            'email' => 'novo@exemplo.com',
            'user_type' => 'teacher'
        ]);



       

       
    }

    public function test_admin_can_update_user(): void
    {
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);

        $updatedUserData = [
            'name' => 'Novo admin',
            'email' => 'exemplo@exemplo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'cpf' => '12345678901',
            'cep' => '12345678',
            'telephone' => '123456789',
            'user_type' => 'admin'
        ];
        $response = $this->put(route('users.update', $user->id), $updatedUserData);

        $response->assertRedirect(route(("users.index")));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'exemplo@exemplo.com',
            'user_type' => 'admin'
        ]);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email' => 'novo@exemplo.com'
        ]);
    }

    public function test_admin_can_delete_user():void{
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);
        $updatedUserData = [
            'name' => 'Novo admin',
            'email' => 'exemplo@exemplo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'cpf' => '12345678901',
            'cep' => '12345678',
            'telephone' => '123456789',
            'user_type' => 'admin'
        ];
        $response = $this->delete(route('users.destroy', $user->id), $updatedUserData);

        $response->assertRedirect(route(("users.index")));

      

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email' => 'exemplo@exemplo.com'
        ]);
    }

    public function test_admin_can_read():void{
        $user = User::factory()->state(['user_type' => 'admin'])->create();
        $this->actingAs($user);

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
    }
}
