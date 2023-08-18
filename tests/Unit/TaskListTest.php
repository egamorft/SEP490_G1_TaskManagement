<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\TaskList;
use App\Models\Board;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;

class TaskListTest extends TestCase
{
    public function testAddTaskListSuccess()
    {
        $requestData = [
            'title' => 'New Task List',
            'board_id' => 1,
        ];
        $this->withoutMiddleware();
        $response = $this->post(route('add.taskList'), $requestData);
        // dd($response);
        $response->assertStatus(200);
    }

    public function testAddTaskListFail()
    {
        $requestData = [
            'title' => '',
            'board_id' => 1,
        ];
        
        $response = $this->post(route('add.taskList'), $requestData);
        // dd($response);
        $response->assertStatus(302);
    }

    public function testEditTitleTaskList()
    {
        $this->withoutMiddleware();

        $response = $this->post(route('edit.taskList'), [
            'newTitle' => "new Title 2",
            'taskListDataId' => 7,
        ]);

        $response->assertStatus(200);
    }

    public function testRemoveTaskList()
    {
        $response = $this->post(route('remove.taskList', ['slug' =>"beatae2"]), [
            'id' => 3,
        ]);
        // dd($response);
        $this->withoutMiddleware();
        // Kiểm tra xem taskList đã được xóa thành công khỏi cơ sở dữ liệu hay chưa
        $response->assertStatus(302);

        
    }
}