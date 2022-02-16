<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use App\Mail\welcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'we are here';
        $users = User::all();
        return view('cms.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'name' => 'required|min:3|max:30',
            'active' => 'required|boolean',
            'email' => 'required'
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->get('name');
            $user->active = $request->get('active');
            $user->email = $request->get('email');
            $isSaved = $user->save();

            Mail::to($user->email)->send(new welcomeEmail($user));

            return response()->json(
                [
                    'message' => $isSaved ? " user Saved Successfuly" : "Failed to Saved"
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
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
    public function edit(User $user)
    {
        return view('cms.users.edit', compact('user', $user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator($request->all(), [
            'name' => 'required|min:3|max:30',
            'active' => 'required|boolean',
            'email' => 'required'
        ]);

        if (!$validator->fails()) {

            $user->name = $request->get('name');
            $user->active = $request->get('active');
            $user->email = $request->get('email');
            $isUpdated = $user->save();

            return response()->json(
                [
                    'message' => $isUpdated ? " user Updated Successfuly" : "Failed to Update"
                ],
                $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $isDeleted = $user->delete();
        if($isDeleted){
            return response()->json([
                'title'=>'Success' , 'text'=>'User Deleted Successfuly' , 'icon'=>'success'
            ],Response::HTTP_OK);
        }else{

            return response()->json([
                'title'=>'Failde' , 'text'=>'User Delete Failde' , 'icon'=>'error'
            ],Response::HTTP_BAD_REQUEST);

        }
    }
}
