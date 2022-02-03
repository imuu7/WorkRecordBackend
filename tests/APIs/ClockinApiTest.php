<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Clockin;

class ClockinApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_clockin()
    {
        $clockin = factory(Clockin::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/clockins', $clockin
        );

        $this->assertApiResponse($clockin);
    }

    /**
     * @test
     */
    public function test_read_clockin()
    {
        $clockin = factory(Clockin::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/clockins/'.$clockin->id
        );

        $this->assertApiResponse($clockin->toArray());
    }

    /**
     * @test
     */
    public function test_update_clockin()
    {
        $clockin = factory(Clockin::class)->create();
        $editedClockin = factory(Clockin::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/clockins/'.$clockin->id,
            $editedClockin
        );

        $this->assertApiResponse($editedClockin);
    }

    /**
     * @test
     */
    public function test_delete_clockin()
    {
        $clockin = factory(Clockin::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/clockins/'.$clockin->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/clockins/'.$clockin->id
        );

        $this->response->assertStatus(404);
    }
}
