<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_authenticated_user_can_access_to_products_list(): void
    {
        // create fake user
        $user=User::factory()->create([
            'email'=>$this->faker->unique()->safeEmail,
            'name'=>$this->faker->userName,
            'password'=>\Hash::make("secret123")
        ]);
        $token=auth()->attempt(['email'=>$user->email,'password'=>'secret123']);
        $response=$this->withHeader('authorization',"bearer ".$token)->getJson('/api/products');

        $response->assertStatus(200);
    }
}
