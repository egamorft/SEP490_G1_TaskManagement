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

class RemoveBoardTest extends TestCase
{
    public function testRemoveBoard()
    {
        // Prepare test data
        $requestData = ['id' => 3];
        $this->withoutMiddleware();
        // Run the remove_board method
        $response = $this->post(route('remove.board', ['slug' =>"eos0"]), $requestData);

        // Assert the response
        $response->assertStatus(200);        
    }

}