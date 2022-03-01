<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = auth('api')->user()->tasks;
        return response()->json([
            'message'=>'success',
            'data'=>$data
        ],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        // $validator =Validator($request->all(),[
        //     'name'=> 'required|min:3',
        //     'description' => 'required|min:3',
        //     'category_id' => 'required|exists:categories,id',
        // ]);
        // if(!$validator->fails()){
        //     $task= new Task();
        //     $task->name = $request->get('name');
        //     $task->description = $request->get('description');
        //     $task->category_id = $request->get('category_id');
        //     $task->user_id = auth('api')->user()->id;
        //     $isSaved =$task->save();
        //     return response()->json([
        //         'message' =>    $isSaved ? 'Created Successfully' : 'Error Creating',
        //         'data' => $task
        //     ],$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        // }else{
        //     return response()->json([
        //         'message'=>$validator->getMessageBag()->first()
        //     ],Response::HTTP_BAD_REQUEST);
        // }
        return $this->createOrUpdate($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->createOrUpdate($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if(!is_null($task)){
            $isDeleted = $task->delete();
            return response()->json([
                'message'=>$isDeleted ? 'Deleted Successfully' : 'Error Deleting',
                'data'=>$task
            ],$isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=>'Task not found'
            ],Response::HTTP_BAD_REQUEST);
        }

    }

    public function createOrUpdate(Request $request, $id = null)
    {
        $validator = Validator($request->all(),[
            'name'=> 'required|min:3',
            'description' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
        ]);
        $successCode = $id ? Response::HTTP_OK : Response::HTTP_CREATED;
        if(!$validator->fails()){
            $task= $id ? Task::findOrFail($id) : new Task();
            $task->name = $request->get('name');
            $task->description = $request->get('description');
            $task->category_id = $request->get('category_id');
            $task->user_id = auth('api')->user()->id;
            $isSaved =$task->save();
            $message = $id ? 'Updated Successfully' : 'Created Successfully';
            return response()->json([
                'message' =>    $isSaved ? $message : 'Error Creating',
                'data' => $task
            ],$isSaved ? $successCode : Response::HTTP_BAD_REQUEST);

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
