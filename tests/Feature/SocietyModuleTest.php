<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Society;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class SocietyModuleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * php artisan test --filter SocietyModuleTest
     * > The user can view the create society page
     * @return void
     */
    public function test_authenticated_user_can_view_create_society_page()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/society/create');

        $response->assertStatus(200);
        $response->assertSee("Add society");
    }

    /**
     * php artisan test --filter SocietyModuleTest
     * > This function tests that a user can view the society listing page
     */
    public function test_authenticated_user_can_view_listing_society_page()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/society/list');

        $response->assertStatus(200);
        $response->assertSee("Societies");
    }

    /**
     * php artisan test --filter SocietyModuleTest
     * > A user can create a society
     */
    public function test_authenticated_user_can_create_society()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        $data = [
            'name' => 'Society Name',
            'address' => 'This is the address.',
            'contact' => 9983045201,
            'description' => 'This is the description.',
            'country' => 105,
            'state' => 29,
            'city' => 1306,
            'postcode' => 302012,
        ];

        // 2. Action
        $response = $this->actingAs($user)->post('/api/societies', $data);

        // 3. Assert
        $this->assertDatabaseHas('societies', $data);

        $society = Society::find(1);

        $this->assertEquals('Society Name', $society->name);
        $this->assertEquals('This is the address.', $society->address);
        $this->assertEquals(9983045201, $society->contact);
        $this->assertEquals('This is the description.', $society->description);
        $this->assertEquals(105, $society->country);
        $this->assertEquals(29, $society->state);
        $this->assertEquals(1306, $society->city);
        $this->assertEquals(302012, $society->postcode);

        // Expected Status : 200
        $response->assertStatus(200);

    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > A user can create a society
     */
    public function test_authenticated_user_can_disable_society()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        $id = Society::get()->random()->id;

        // 2. Action
        $response = $this->actingAs($user)->get(route('societies.disable', $id));

        // Expected Status : 200
        $response->assertStatus(200);

        // Expected JSON Response
        $response->assertSee("Record disabled successfully.");
    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > A user can create a society
     */
    public function test_authenticated_user_can_enable_society()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        $id = Society::get()->random()->id;

        // 2. Action
        $response = $this->actingAs($user)->get(route('societies.enable', $id));

        // Expected Status : 200
        $response->assertStatus(200);

        // Expected JSON Response
        $response->assertSee("Record enabled successfully.");
    }

    // API Tests Starts From Here.

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > We are testing that a logged in/authenticated user can create a society from the API
     */
    public function test_authenticated_user_can_create_society_api()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        $data = [
            'name' => 'Society Name',
            'address' => 'This is the address.',
            'contact' => 9983045201,
            'description' => 'This is the description.',
            'country' => 105,
            'state' => 29,
            'city' => 1306,
            'postcode' => 302012,
        ];

        // 2. Action
        $response = $this->actingAs($user)->post('/api/societies', $data);

        // 3. Assert
        $this->assertDatabaseHas('societies', $data);

        $society = Society::find(1);

        $this->assertEquals('Society Name', $society->name);
        $this->assertEquals('This is the address.', $society->address);
        $this->assertEquals(9983045201, $society->contact);
        $this->assertEquals('This is the description.', $society->description);
        $this->assertEquals(105, $society->country);
        $this->assertEquals(29, $society->state);
        $this->assertEquals(1306, $society->city);
        $this->assertEquals(302012, $society->postcode);

        // Expected Status : 200
        $response->assertStatus(200);

        // Expected JSON Response
        $response->assertJson([
            'success' => true,
            'message' => "Record created successfully.",
        ]);
    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > We are testing that a logged in/authenticated user can update a society from the API
     */
    public function test_authenticated_user_can_update_society_api()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        $id = Society::get()->random()->id;

        // 2. Action
        $data = [
            'name' => 'Society Name',
            'address' => 'This is the address.',
            'contact' => 9983045201,
            'description' => 'This is the description.',
            'country' => 105,
            'state' => 29,
            'city' => 1306,
            'postcode' => 302012,
        ];

        $this->actingAs($user)->put(route('societies.update', $id), $data)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => "Record updated successfully.",
            ]);
    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > A authenticated user can create a society
     */
    public function test_authenticated_user_can_see_society_list_api()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        // 2. Action
        $response = $this->actingAs($user)->get('/api/societies');

        // Expected Status : 200
        $response->assertStatus(200);

        // Expected JSON Response
        $response->assertJson([
            'success' => true,
            'message' => "Records retrieved successfully.",
        ]);
    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > A authenticated user can view a society details
     */
    public function test_authenticated_user_can_view_a_society_details_api()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        $id = Society::get()->random()->id;

        // 2. Action
        $response = $this->actingAs($user)->get(route('societies.show', $id));

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => "Record retrieved successfully.",
            ]);
    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > A authenticated user can enable a society
     */
    public function test_authenticated_user_can_enable_society_api()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        // 2. Action
        $response = $this->actingAs($user)->get(route('societies.enable', 1));

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => "Record enabled successfully.",
            ]);
    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > A authenticated user can disable a society
     */
    public function test_authenticated_user_can_disable_society_api()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        // 2. Action
        $response = $this->actingAs($user)->get(route('societies.disable', 1));

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => "Record disabled successfully.",
            ]);
    }

    /**
     * For running this specific test.
     * php artisan test --filter SocietyModuleTest
     * > A authenticated user can disable a society
     */
    public function test_authenticated_user_can_delete_society_api()
    {
        // 1. Because we are authenticating with sanctrum.
        $user = \App\Models\User::factory()->create();

        $id = Society::get()->random()->id;

        // 2. Action
        $response = $this->actingAs($user)->delete(route('societies.destroy', $id));

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => "Record deleted successfully.",
            ]);
    }
    
}
