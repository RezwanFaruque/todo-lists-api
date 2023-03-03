<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodoTask;
use Validator;

class TodoTaskController extends Controller
{
        // return the list of todos with task
        public function index(){

        
            $alltodotakslist = TodoTask::with('todo')->get();
    
            $data = [
                'status' => 'success',
                'data' => $alltodotakslist,
            ];
    
            return response()->json($data);
    
        }
    
    
        public function store(Request $request){
    
            $validator = Validator::make($request->all(), [
                'task_name' => 'required',
                'task_description' => 'required',
                'duration' => 'required',
                'todolist_id' => 'required|exists:todo_lists,id',
            ]);
    
            $data = [];
    
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }else{
    
                $todotask = new TodoTask();
    
                $todotask->task_name = $request->task_name;
                $todotask->task_description = $request->task_description;

                $todotask->duration = $request->duration;
                $todotask->todolist_id = $request->todolist_id;
                $todotask->is_complete = 0;


    
                $todotask->save();
    
                $data = [
                    'status' => 'success',
                    'message' => 'Todotask added successfully!'
                ];
    
            }
    
            return response()->json($data);
    
        }
    
    
    
        public function details($id){
    
            $todotask = TodoTask::findOrFail($id);
    
            $data = [];
            if($todotask){
    
                $data = [
                    'status' => 'success',
                    'data' => $todotask,
                ];
    
    
            }
    
            return response()->json($data);
        }
    
    
        public function update(Request $request ,$id){
    
    
            $validator = Validator::make($request->all(), [
                'task_name' => 'required',
                'task_description' => 'required',
                'duration' => 'required',
                'todolist_id' => 'required|exists:todo_lists,id',
            ]);
    
            $data = [];
    
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }else{
    
                $todotask = TodoTask::findOrFail($id);
    
                $todotask->task_name = $request->task_name;
                $todotask->task_description = $request->task_description;

                $todotask->duration = $request->duration;
                $todotask->todolist_id = $request->todolist_id;
                $todotask->is_complete = 0;


    
                $todotask->update();
    
                $data = [
                    'status' => 'success',
                    'message' => 'Todotask updated successfully!'
                ];
    
            }
    
            return response()->json($data);
        }
    
    
        public function delete($id){
    
            $todo = TodoTask::findOrFail($id);
    

            $todo->delete();
    
            $data = [
                'status' => 'success',
                'message' => 'Todotask deleted successfully!'
            ];
    
            return response()->json($data);
        }
}
