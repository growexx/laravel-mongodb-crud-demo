<?php

namespace Tests\Feature;

use App\Models\Task as ModelsTask;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Task;
use Faker\Factory;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Index(){

        $response = $this->get('http://127.0.0.1:8000/tasks');
        $response->assertStatus(200);
    }
    public function test_createTask(){

        $response = $this->get('http://127.0.0.1:8000/tasks/create');
        $response->assertStatus(200);
    }
    public function test_StoreTask()
    {
        $response = $this->call('POST', 'http://127.0.0.1:8000/tasks', [
            'title' => '15',
            'status' => '10'
        ]);
        $response->assertStatus(302);

    }
    public function test_ShowTask()
    {
        $response = $this->get('http://127.0.0.1:8000/tasks/62cd43965a374fa6a4023fb2');
        $response->assertStatus(200);
    }
    public function test_deleteTask()
    {
        $response = $this->call('DELETE', 'http://127.0.0.1:8000/tasks/62cd68bfd20b0a3bbb0a6732', [
            'title' => '122',
            'status' => '10',
            'hoursRequired' => '5',
            'hoursConsumed' => '3',
        ]);
        $response->assertStatus(302);
    }
    public function test_updateTask()
    {
        $response = $this->call('PUT', 'http://127.0.0.1:8000/tasks/62cd43965a374fa6a4023fb2', [
            'title' => 'This is Test',
            'status' => '10',
            'discription' => 'new task',
            'hoursRequired' => '5',
            'hoursConsumed' => '3',
        ]);
        $response->assertStatus(302);
    }
    public function test_editTask()
    {
        $response = $this->call('GET', 'http://127.0.0.1:8000/tasks/62c7f4d082e2b3917f0b30df/edit', [
            'title' => '11',
            'status' => '10',
            'discription' => 'new task',
            'hoursRequired' => '5',
            'hoursConsumed' => '3',
        ]);
        $response->assertStatus(200);
    }
}
