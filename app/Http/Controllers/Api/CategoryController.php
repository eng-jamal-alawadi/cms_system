<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $data = Category::where('user_id',auth('api')->user()->id)->get();
        $data =auth('api')->user()->categories;
        return response()->json([
            'message'=>'success',
            'data'=>$data
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator($request->all(),[
        //     'name'=> 'required|min:3',
        //     'active' => 'required|boolean'
        // ]);

        // if(!$validator->fails()){
        //     $category= new Category();
        //     $category->name = $request->get('name');
        //     $category->active = $request->get('active');
        //     // $category->user_id = auth('api')->user()->id;
        //     // $isSaved= $category->save();
        //     // another way to save
        //     $isSaved =auth('api')->user()->categories()->save($category);
        //     return response()->json([
        //         'message'=>$isSaved?'success': 'failed to save',
        //         'data'=>$category
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validator = Validator($request->all(),[
        //     'name'=> 'required|min:3',
        //     'active' => 'required|boolean'
        // ]);

        // if(!$validator->fails()){
        //     $category= Category::findOrFail($id);
        //     $category->name = $request->get('name');
        //     $category->active = $request->get('active');

        //     $isSaved =auth('api')->user()->categories()->save($category);
        //     return response()->json([
        //         'message'=>$isSaved?'success': 'failed to update',
        //         'data'=>$category
        //     ],$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        // }else{
        //     return response()->json([
        //         'message'=>$validator->getMessageBag()->first()
        //     ],Response::HTTP_BAD_REQUEST);
        // }

        return $this->createOrUpdate($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $isDeleted = $category->delete();
        $category= Category::find($id);
        if(!is_null($category)){
            $isDeleted = $category->delete();
            $this->authorize('delete',$category);
            return response()->json([
                'message'=>$isDeleted?'success': 'failed to delete',

            ],$isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else{
            return response()->json([
                'message'=>'item not found'
            ],Response::HTTP_BAD_REQUEST);
        }


    }

    public function createOrUpdate(Request $request,$id=null){
        $validator = Validator($request->all(),[
            'name'=> 'required|min:3',
            'active' => 'required|boolean'
        ]);

        if(!$validator->fails()){
            $category= $id == null? new Category() : Category::findOrFail($id);
            $category->name = $request->get('name');
            $category->active = $request->get('active');
            $successCode = $id == null ? Response::HTTP_CREATED : Response::HTTP_OK;
            $isSaved =auth('api')->user()->categories()->save($category);
            return response()->json([
                'message'=>$isSaved?'success': 'failed to update',

            ],$isSaved ? $successCode : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
