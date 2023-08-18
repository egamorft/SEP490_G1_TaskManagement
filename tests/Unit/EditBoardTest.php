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

class EditBoardTest extends TestCase
{
    public function testEditBoardSuccess()
    {
        // Prepare test data
        $requestData = [
            'id' => 3,
            'modalBoardTitleEdit' => 'New Title',
        ];
        $this->withoutMiddleware();
        // Run the edit_board method
        $response = $this->post(route('edit.board', ['slug' =>"eos0"]), $requestData);
        // dd($response);
        // Assert the response
        $response->assertStatus(200);
    }

    public function testEditBoardFail()
    {
        // Prepare test data
        $requestData = [
            'id' => 3,
            'modalBoardTitleEdit' => '',
        ];
        $this->withoutMiddleware();
        // Run the edit_board method
        $response = $this->post(route('edit.board', ['slug' =>"eos0"]), $requestData);
        dd($response);
        // Assert the response
        $response->assertStatus(302);
    }
}