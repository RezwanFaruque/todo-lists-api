<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TodoList;

class TodoTest extends TestCase
{
    /**
     * A basic feature test for get all todo lists.
     *
     * @return void
     */
    public function test_get_all_todo_lists()
    {
        $alltodo = TodoList::with('todotasks')->get();
        $response = $this->get('/api/todo-lists');
        $response->assertStatus(200);
        
        $response->assertJson(
            [
                'status' => 'success',
            ]
        );
    }



    /**
     * A basic feature test for create todo.
     *
     * @return void
     */


     public function test_create_todo(){

        $response = $this->postJson('/api/todo/add', ['name' => 'Test Task' , 'due_date' => '2023-03-05 11:05:02']);

        $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
        ]);
     }




}
