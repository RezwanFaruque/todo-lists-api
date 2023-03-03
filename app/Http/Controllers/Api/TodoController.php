<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\TodoTask;
use Validator;

class TodoController extends Controller
{
    
    // return the list of todos with task
    public function index(){

        
        $alltodolist = TodoList::with('todotasks')->get();

        $data = [
            'status' => 'success',
            'data' => $alltodolist,
        ];

        return response()->json($data);

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'due_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $data = [];

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }else{

            $todolist = new TodoList();

            $todolist->name = $request->name;
            $todolist->due_date = $request->due_date;

            $todolist->save();

            $data = [
                'status' => 'success',
                'message' => 'TodoList added successfully!'
            ];

        }

        return response()->json($data);

    }



    public function details($id){

        $todo = TodoList::findOrFail($id);

        $data = [];
        if($todo){

            $data = [
                'status' => 'success',
                'data' => $todo,
            ];


        }

        return response()->json($data);
    }


    public function update(Request $request ,$id){


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'due_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $data = [];

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }else{

            $todolist = TodoList::findOrFail($id);

            $todolist->name = $request->name;
            $todolist->due_date = $request->due_date;

            $todolist->update();

            $data = [
                'status' => 'success',
                'message' => 'TodoList updated successfully!'
            ];

        }

        return response()->json($data);
    }


    public function delete($id){

        $todo = TodoList::findOrFail($id);


        TodoTask::where('todolist_id',$todo->id)->delete();

        $todo->delete();

        $data = [
            'status' => 'success',
            'message' => 'Todo list and related to tasks deleted successfully!'
        ];

        return response()->json($data);
    }
}
