<?php
namespace Tests\Feature;
use App\Models\Flower;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;


class FlowerTest extends TestCase
{
    /**
     * Test dat api/flower/{id} werkt (GET)
     * @return void
     */
    public function test_flower_op_id()
{
    Sanctum::actingAs(User::factory()->create(), ['*']);
    $response = $this->get('api/flowers/1');
    $response->assertStatus(200);
    // $response->assertJson(['flower_name' => 'Rose','flower_type' => 'native',]);
}

    /**
     * Test dat api/flowers?naam={naam} (GET)
     * @return void
     */
    public function test_flower_op_naam()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);

        $response = $this->get('api/flowers?flower_name=R');
        $response->assertStatus(200);
        // $response->assertJsonCount(1);
        // $response->assertJsonFragment(['flower_name'=>'Rose','flower_type'=>'native', ]);
    }

     /**
     * Test dat api/flowers werkt, om flower toe te voegen (POST) 
     * @return void
     */
    public function test_insert_flower()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        // Maak flower
        $data = ['flower_name'=>'Rose', 'flower_type'=> 'native', 'store_id' => 1];
        // gebruik de API
        $response = $this->json('POST','api/flowers', $data);
        // stel vast dat de database in de tabel flowers de toegevoegde flower heeft
        $this->assertDatabaseHas('flowers', 
                ['flower_name'=>'Rose','flower_type'=>'native', ]);
        $response->assertStatus(201);
        // $response->assertJson(['flower_name'=>'Rose','flower_type'=>'native', ]);        
    }

     /**
     * Test dat api/flowers werkt, om flowers toe te voegen (DELETE) 
     * @return void
     */
    public function test_delete_flower()
    {
        Sanctum::actingAs(User::factory()->create(),['*']);
        $response = $this->delete('api/flowers/4');
        $response->assertStatus(202);
    }
}
