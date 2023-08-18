<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\User;
use App\Models\TaskList;
use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function testAddTaskKanban()
    {
        // Tạo dữ liệu mẫu
        $task_title = 'New Task Title';
        $taskListDataId = 'some_task_list_data_id_1'; // Thay đổi thành giá trị tương ứng
        $taskListId = 1; // Thay đổi thành giá trị tương ứng

        $user = User::find(2);

        Auth::login($user);

        $this->withoutMiddleware();
        // Gửi yêu cầu POST đến route 'add.task.kanban'
        $response = $this->post(route('add.task.kanban'), [
            'task_title' => $task_title,
            'taskListDataId' => $taskListDataId,
        ]);

        // Kiểm tra xem phản hồi có mã trạng thái HTTP là 200 (OK) hay không
        $response->assertStatus(200);       
    }

    public function testAddTaskCalendarModal()
    {
        $boardId = 4; 
        $startDate = '2023-08-16'; 
        $endDate = '2023-08-20'; 
        $taskListId = 1; 
        $taskTitle = 'New Task'; 
        $previousTask = null; 
        $description = 'Task description'; 

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('add.task.modal',['slug' =>"beatae0", 'board_id' => $boardId]), [
            'modalAddTaskDuration' => $startDate . ' to ' . $endDate,
            'modalAddTaskList' => $taskListId,
            'modalAddTaskTitle' => $taskTitle,
            'modalAddTaskAssignee' =>  Auth::id(),
            'modalAddPreviousTask' => $previousTask,
            'description' => $description,
        ]);

        $response->assertStatus(200);
    }
    
    public function testAddTaskCalendarModalFail()
    {
        $boardId = 4; // Thay đổi thành giá trị tương ứng
        $startDate = '2023-08-10'; // Thay đổi thành giá trị tương ứng
        $endDate = '2023-08-15'; // Thay đổi thành giá trị tương ứng
        $taskListId = 1; // Thay đổi thành giá trị tương ứng
        $taskTitle = 'New Task'; 
        $previousTask = null; 
        $description = 'Task description'; 

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('add.task.modal',['slug' =>"beatae0", 'board_id' => $boardId]), [
            'modalAddTaskDuration' => $startDate . ' to ' . $endDate,
            'modalAddTaskList' => $taskListId,
            'modalAddTaskTitle' => $taskTitle,
            'modalAddTaskAssignee' =>  Auth::id(),
            'modalAddPreviousTask' => $previousTask,
            'description' => $description,
        ]);

        $response->assertStatus(422);
    }

    public function testAddTaskListModal()
    {
        $boardId = 4; // Thay đổi thành giá trị tương ứng
        $startDate = '2023-08-16'; // Thay đổi thành giá trị tương ứng
        $endDate = '2023-08-20'; // Thay đổi thành giá trị tương ứng
        $taskListId = 1; // Thay đổi thành giá trị tương ứng
        $taskTitle = 'New Task'; 
        $previousTask = null; 
        $description = 'Task description'; 

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('add.task.modal',['slug' =>"beatae0", 'board_id' => $boardId]), [
            'modalAddTaskDuration' => $startDate . ' to ' . $endDate,
            'modalAddTaskList' => $taskListId,
            'modalAddTaskTitle' => $taskTitle,
            'modalAddTaskAssignee' =>  Auth::id(),
            'modalAddPreviousTask' => $previousTask,
            'description' => $description,
        ]);

        $response->assertStatus(200);
    }

    public function testAddTaskListModalFail()
    {
        $boardId = 4; // Thay đổi thành giá trị tương ứng
        $startDate = '2023-08-10'; // Thay đổi thành giá trị tương ứng
        $endDate = '2023-08-15'; // Thay đổi thành giá trị tương ứng
        $taskListId = 1; // Thay đổi thành giá trị tương ứng
        $taskTitle = 'New Task'; 
        $previousTask = null; 
        $description = 'Task description'; 

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('add.task.modal',['slug' =>"beatae0", 'board_id' => $boardId]), [
            'modalAddTaskDuration' => $startDate . ' to ' . $endDate,
            'modalAddTaskList' => $taskListId,
            'modalAddTaskTitle' => $taskTitle,
            'modalAddTaskAssignee' =>  Auth::id(),
            'modalAddPreviousTask' => $previousTask,
            'description' => $description,
        ]);

        $response->assertStatus(422);
    }

    public function testCommentTask()
    {
        $taskId = 1; // Thay đổi thành giá trị tương ứng
        $content = 'This is a comment'; // Thay đổi thành giá trị tương ứng

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('comment.task'), [
            'id' => $taskId,
            'content' => $content,
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteTask()
    {
        $taskId = 7; // Thay đổi thành giá trị tương ứng
        $slug = 'beatae2'; // Thay đổi thành giá trị tương ứng
        $boardId = 1; // Thay đổi thành giá trị tương ứng

        $this->withoutMiddleware();

        $response = $this->post(route('delete.task'), [
            'task_id' => $taskId,
            'slug' => $slug,
            'board_id' => $boardId,
        ]);

        // dd($response);

        $response->assertStatus(200);
    }

    public function testChangeDesc()
    {
        $taskId = 1; // Thay đổi thành giá trị tương ứng
        $newDescription = 'New task description'; // Thay đổi thành giá trị tương ứng

        $this->withoutMiddleware();

        $response = $this->post(route('change.desc'), [
            'description' => $newDescription,
            'id' => $taskId,
        ]);

        $response->assertStatus(200);
    }

    public function testChangeAssignee()
    {
        $taskId = 1; // Thay đổi thành giá trị tương ứng
        $userId = 2; // Thay đổi thành giá trị tương ứng

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('change.assignee'), [
            'user_id' => $userId,
            'task_id' => $taskId,
        ]);

        $response->assertStatus(200);
    }

    public function testChangeReviewer()
    {
        $taskId = 1; // Thay đổi thành giá trị tương ứng
        $userId = 2; // Thay đổi thành giá trị tương ứng

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('change.reviewer'), [
            'user_id' => $userId,
            'task_id' => $taskId,
        ]);

        $response->assertStatus(200);
    }

    public function testChangeDuration()
    {
        $taskId = 1; // Thay đổi thành giá trị tương ứng
        $startDate = '2023-08-017'; // Thay đổi thành giá trị tương ứng
        $endDate = '2023-08-18'; // Thay đổi thành giá trị tương ứng

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('change.duration'), [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'task_id' => $taskId,
        ]);

        $response->assertStatus(200);
    }

    public function testChangeDuration1()
    {
        $taskId = 1; // Thay đổi thành giá trị tương ứng
        $startDate = '2023-08-010'; // Thay đổi thành giá trị tương ứng
        $endDate = '2023-08-12'; // Thay đổi thành giá trị tương ứng

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('change.duration'), [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'task_id' => $taskId,
        ]);

        $response->assertStatus(404);
    }

    public function testDeleteTask1()
    {
        $requestData = [
            'task_id' => 1,
            'slug' => 'ea3',
            'board_id' => 3,
        ];

        $this->withoutMiddleware();

        $response = $this->post(route('delete.task'), $requestData);
        $response->assertStatus(200);
    }

    public function testSetTaskDone()
    {
        $requestData = [
            'task_id' => 1,
        ];

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('set.taskDone'), $requestData);

        $response->assertStatus(200);
    }

    public function testSetTaskFinish()
    {
        $requestData = [
            'task_id' => 1,
        ];

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('set.taskFinish'), $requestData);

        $response->assertStatus(200);
    }

    public function testRejectTask()
    {
        $requestData = [
            'modalRejectAssignTo' => 2,
            'modalRejectReason' => 'Task needs to be redone',
            'task-id' => 1,
        ];

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('reject.task'), $requestData);

        $response->assertStatus(200);
    }     

    public function testGanttStore()
    {
        $requestData = [
            'parent' => 4,
            'text' => 'New Task',
            'start_date' => '2023-08-17',
            'end_date' => '2023-08-18',
        ];

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('store.task.gantt'), $requestData);

        $response->assertStatus(200);
    }

    public function testGanttStoreFail()
    {
        $requestData = [
            'parent' => 4,
            'text' => '',
            'start_date' => '2023-08-17',
            'end_date' => '2023-08-18',
        ];

        $user = User::find(2);
        Auth::login($user);

        $response = $this->post(route('store.task.gantt'), $requestData);

        $response->assertStatus(500);
    }

    public function testGanttUpdate(){

        $requestData = [
            'text' => 'Updated Task',
            'start_date' => '2023-08-17',
            'duration' => 2,
        ];

        $user = User::find(2);
        Auth::login($user);

        $response = $this->put(route('update.task.gantt', ['id' => 1]), $requestData);

        $response->assertStatus(200);
    }

    public function testGanttUpdate1(){

        $requestData = [
            'text' => '',
            'start_date' => '2023-08-17',
            'duration' => 2,
        ];

        $user = User::find(2);
        Auth::login($user);

        $response = $this->put(route('update.task.gantt', ['id' => 1]), $requestData);

        $response->assertStatus(500);
    }

    public function testGanttDelete()
    {
        $user = User::find(2);
        Auth::login($user);

        $response = $this->delete(route('delete.task.gantt', ['id' => 2]));

        $response->assertStatus(200);
    }

    public function testLinkStore()
    {
        $requestData = [
            'source' => 1,
            'target' => 2,
        ];

        $this->withoutMiddleware();

        $response = $this->post(route('store.link.gantt'), $requestData);

        $response->assertStatus(200);
    }

    
}
