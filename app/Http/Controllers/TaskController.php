<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
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
        $this->authorize('viewAny', Task::class);

        // $user = auth()->user();
        // $tasks = Task::where('category_id', $user->categories()->first()->id)->get();
       if(auth()->guard('admin')->check()){
        $tasks = Task::all();
        return view('cms.tasks.index', compact('tasks',$tasks));

       } else{
        $tasks =  auth()->user()->tasks;
        return view('cms.tasks.index', compact('tasks',$tasks));

       }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        $categories = auth()->user()->categories;
        return view('cms.tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Task::class);

        $validator = Validator($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',

        ]);

        if(!$validator->fails()){
            $task = new Task();
            $task->name = $request->name;
            $task->description = $request->description;
            $task->category_id = $request->category_id;
            $isSaved = $task->save();
            return response()->json(['message' => $isSaved ? 'Task created' : 'Task not created'
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message' =>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Task $task)
    {
        $this->authorize('update', $task);

        $categories = auth()->user()->categories;
        return view('cms.tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validator = Validator($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',

        ]);

        if(!$validator->fails()){

            $task->name = $request->name;
            $task->description = $request->description;
            $task->category_id = $request->category_id;
            $isSaved = $task->save();
            return response()->json(['message' => $isSaved ? 'Task updated' : 'Task not updated'
        ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message' =>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $isDeleted = $task->delete();
        return response()->json([
        'title' => 'Task deleted',
        'text' => 'Task deleted',
        'icon' => 'success',

    ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
