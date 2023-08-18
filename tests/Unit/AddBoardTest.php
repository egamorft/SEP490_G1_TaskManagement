<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Board;
use app\Http\Controllers\AuthController;

class AddBoardTest extends TestCase
{
    use DatabaseTransactions;

    public function testAddBoardSuccessfully()
    {
        // Disable exception handling to see the actual validation errors
        $this->withoutExceptionHandling();
        
        // Create a mock request with necessary input data
        $requestData = [
            'project_id' => 1,
            'modalBoardName' => 'Test Board',
        ];
        $this->withoutMiddleware();
        // Call the add_board route
        $response = $this->post(route('add.board', ['slug' =>"eos0"]), $requestData);
      
        // Assert the response
        
        $response->assertStatus(200);
        
        
    }
        
    public function testAddBoardFail()
    {
        // Disable exception handling to see the actual validation errors
        $this->withoutExceptionHandling();
        
        // Create a mock request with necessary input data
        $requestData = [
            'project_id' => 1,
            'modalBoardName' => '',
        ];
        $this->withoutMiddleware();
        // Call the add_board route
        $response = $this->post(route('add.board', ['slug' =>"eos0"]), $requestData);
      
        // Assert the response
        
        $response->assertStatus(422);        
    }

    public function testAddBoardWithoutLogin()
    {
        // Disable exception handling to see the actual validation errors
        $this->withoutExceptionHandling();
        
        // Create a mock request with necessary input data
        $requestData = [
            'project_id' => 1,
            'modalBoardName' => '',
        ];
        
        // Call the add_board route
        $response = $this->post(route('add.board', ['slug' =>"eos0"]), $requestData);
      
        // Assert the response
        
        $response->assertStatus(302);        
    }
    
}