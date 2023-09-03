<?php


namespace Tests\Feature;

use Tests\TestCase;
use Domain\Product\Models\Product;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Http;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    private $user;
    private $token;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('secret1234'),
        ]);
        
        $this->token = JWTAuth::fromUser($this->user);
        
    }
    
    /**
     * @test 
     * Test the Create route
     */
    public function testCreate(){

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            ])->json('POST',
            route('product.create'),
            Product::factory()->raw());

        $response->assertStatus(200);

        $this->assertEquals(1, Product::count());
        
    }    
    /**
     *  
     * Test the List route
     */
    public function testList(){

        $products = Product::factory()->count(5)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            ])->json('GET',
            route('product.list'));

        $response->assertStatus(200);
        $this->assertEquals(5, Product::count());
        
    }

    /**
     *  
     * Test the Update route
     */
    public function testUpdate(){

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            ])->json('PUT',
            route('product.update', ['product' => $product]),
            ['name' => 'updated']);

        $response->assertStatus(200);
        $this->assertEquals('updated', $response->getData()->resource->product->name);
        
    } 

  
    /**
     *  
     * Test the Show route
     */
    public function testShow(){

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            ])->json('GET',
            route('product.show', ['product' => $product]));

        $response->assertStatus(200);
        $this->assertEquals($product->name, $response->getData()->resource->product->name);
        
    }   
    /**
     *  
     * Test the Delete route
     */
    public function testDelete(){

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $this->token,
            ])->json('POST',
            route('product.delete', ['product' => $product]));

        $response->assertStatus(200);
        $this->assertEquals(0, Product::where('id',$product->id)->count());
        
    } 
}
