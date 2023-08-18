<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Role;
use App\Models\AccountProject;
use App\Models\PermissionRole;
use App\Models\ProjectRolePermission;
use App\Mail\ProjectInvitation;
use Illuminate\Support\Facades\Mail;
use app\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProjectTest extends TestCase
{
    // public function testStore()
    // {
    //     $requestData = [
    //         'modalAddProjectName' => 'Test Project',
    //         'duration' => '2023-08-15 to 2023-08-20',
    //         'modalAddDesc' => 'Test project description',
    //         'modalAddSupervisor' => 3,
    //         'modalAddMembers' => [2],
    //     ];
    //     $this->withoutMiddleware();

    //     $response = $this->post('add-project', $requestData);
    //     dd($response);
    //     $response->assertStatus(200);
            
    // }

     // public function testRejectProject()
    // {
    //     $requestData = [
    //         'id' => 4,
    //         'reason' => 'Rejected due to some reason',
    //     ];
    //     $user = User::find(2);
    //     Auth::login($user);

    //     $response = $this->post(route('reject.project'), $requestData);
    //     $response->assertStatus(200);
    // }

    // public function testApproveProject()
    // {
    //     $requestData = [
    //         'id' => 4,
    //         'reason' => 'Approved with some reason',
    //     ];

    //     $user = User::find(3);
    //     Auth::login($user); 

    //     $response = $this->post(route('approve.project'), $requestData);

    //     $response->assertStatus(200);
    // }

    // public function testStore()
    // {
    //     $user = User::find(2);
    //     Auth::login($user); 
        
    //     $requestData = [
    //         'modalAddProjectName' => 'Test Project',
    //         'duration' => '2023-08-18 to 2023-08-31',
    //         'modalAddDesc' => 'Test project description',
    //         'modalAddSupervisor' => 3,
    //         'modalAddMembers' => [7],
    //     ];

    //     $this->actingAs($user);

    //     $response = $this->post(route('add.project'), $requestData);

    //     $response->assertStatus(200);
    // }
}