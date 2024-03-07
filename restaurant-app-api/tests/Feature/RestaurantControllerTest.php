<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Restaurant;
use App\Http\Controllers\RestaurantController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

class RestaurantControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_restaurants()
    {
        $restaurants = Restaurant::factory()->count(3)->create();

        $controller = new RestaurantController();
        $response = $controller->index();

        $this->assertEquals($restaurants->toArray(), $response->toArray());
    }

    /** @test */
    public function it_creates_a_new_restaurant()
    {
        $data = [
            'name' => 'Test Restaurant',
            'cuisine' => 'Test Cuisine',
            'rating' => 4.5,
        ];

        $controller = new RestaurantController();
        $response = $controller->store(new \Illuminate\Http\Request($data));

        $this->assertDatabaseHas('restaurants', $data);
        $this->assertEquals(201, $response->status());
    }

    /** @test */
    public function it_returns_a_specific_restaurant()
    {
        $restaurant = Restaurant::factory()->create();

        $controller = new RestaurantController();

        $response = $controller->show($restaurant->id);

        $this->assertEquals($restaurant->toArray(), $response->getData(true));
    }

    /** @test */
    public function it_updates_a_restaurant()
    {
        $restaurant = Restaurant::factory()->create();

        $data = [
            'name' => 'Updated Restaurant',
            'cuisine' => 'Updated Cuisine',
            'rating' => 4.0,
        ];

        $controller = new RestaurantController();
        $response = $controller->update(new \Illuminate\Http\Request($data), $restaurant->id);

        $this->assertDatabaseHas('restaurants', $data);
        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function it_deletes_a_restaurant()
    {
        $restaurant = Restaurant::factory()->create();
        $controller = new RestaurantController();

        $controller->destroy($restaurant->id);

        $this->assertDatabaseMissing('restaurants', ['id' => $restaurant->id]);
    }
}