<?php


namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
   
    

    public function addTask(Request $request) {

        $request_data = $request->only([
            'title',
            'description'
        ]);
        $request_data['status'] = 'pending';

        $task = Task::create($request_data);
        if (!empty($task)){
            $response_message['status'] = 'success';
            $response_message['message'] = 'Task was successfully created!';
            $response_message['result'] = $task;

            return response()->json($response_message, 200);
        }
        $response_message['status'] = 'failed';
        $response_message['message'] = 'Failed to create a task!';

        return response()->json($response_message, 409);

    }

    public function getall() {
        $tasks = Task::get();

        if (!empty($tasks)){
            $response_message['status'] = 'success';
            $response_message['message'] = 'Tasks was successfully retrieved!';
            $response_message['result'] = $tasks;

            return response()->json($response_message, 200);
        } else {
            $response_message['status'] = 'success';
            $response_message['message'] = 'Tasks was successfully retrieved!';
            $response_message['result'] = $tasks;

            return response()->json($response_message, 200);
         }

        $response_message['status'] = 'failed';
        $response_message['message'] = 'Failed to retrieved all task!';

        return response()->json($response_message, 500);
    }

    public function get($id) {
        $task = Task::where('id', $id)->first();

        if (!empty($task)){
            $response_message['status'] = 'success';
            $response_message['message'] = 'Tasks was successfully retrieved!';
            $response_message['result'] = $task;

            return response()->json($response_message, 200);
        } else {
            $response_message['status'] = 'success';
            $response_message['message'] = 'Tasks was successfully retrieved!';
            $response_message['result'] = $task;

            return response()->json($response_message, 200);
         }

        $response_message['status'] = 'failed';
        $response_message['message'] = 'Failed to retrieved task!';

        return response()->json($response_message, 500);
    }

    public function updateTask(Request $request, $id) {
        $request_data = $request->only([
            'title',
            'description'
        ]);
        $task = Task::where('id', $id)->first();

        if(!empty($task)){
            if ($task->update($request_data)){
                $response_message['status'] = 'success';
                $response_message['message'] = 'Task was successfully update!';
                $response_message['result'] = $task;
                return response()->json($response_message, 200);
            }
        }

       
        $response_message['status'] = 'failed';
        $response_message['message'] = 'Failed to update a task!';

        return response()->json($response_message, 409);

    }

    public function delete($id){
        $task = Task::where('id', $id)->first();

        if (!empty($task)) {
            $task->delete();
            $response_message['status'] = 'success';
            $response_message['message'] = 'Task was successfully deleted!';
            return response()->json($response_message, 200);
        }

        $response_message['status'] = 'failed';
        $response_message['message'] = 'Failed to delete a task!';

        return response()->json($response_message, 409);
    }

    public function changeStatus ($id, $status) {
        $task = Task::where('id', $id)->first();

        if (!empty($task)) {
            $task->status = $status;
            if ($task->update()) {
                $response_message['status'] = 'success';
                $response_message['message'] = 'Task status was successfully changed!';
                return response()->json($response_message, 200);
            }
        } 
        $response_message['status'] = 'failed';
        $response_message['message'] = 'Failed to change status of a task!';

        return response()->json($response_message, 409);
    }

}
