<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        // Create necessary data using the CreateData trait
        $brand = $this->createBrand('Example Brand');
        $category = $this->createCategory('Example Category', 'example-category');

        // Create a product using the createProduct function
        $product = $this->createProduct('Example Product', $brand->id, $category->id);

        // Your test logic here
        $response = $this->get('/');

        // Example assertion (checking for a 500 status, replace with your actual test logic)
        $response->assertStatus(500);

        // You can also use the created product in your assertions if needed
        $this->assertTrue($product->exists);
    }
}