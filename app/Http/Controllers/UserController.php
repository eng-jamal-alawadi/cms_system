<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use App\Mail\welcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
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
        $this->authorize('ViewAny', User::class);
        // return 'we are here';
        $users = User::withCount('permissions')->get();
        return view('cms.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        // $roles = Role::all();
        return view('cms.users.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validator = Validator($request->all(), [
            'name' => 'required|min:3|max:30',
            'active' => 'required|boolean',
            // 'role_name' => 'required',
            'email' => 'required'
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->get('name');
            $user->active = $request->get('active');
            $user->email = $request->get('email');
            $isSaved = $user->save();
            // $user ->assignRole($request->get('role_name'));

            // DB::table('model_has_roles')->insert([
            //     'role_id'=>$request->get('role_name'),
            //     'model_id'=>$user->id,
            //     'model_type'=>'User'
            // ]);
            // Mail::to($user->email)->send(new welcomeEmail($user));

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
        $this->authorize('update', $user);

        // $roles = Role::all();

        return view('cms.users.edit', ['user' => $user ]);
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
        $this->authorize('update', $user);

        $validator = Validator($request->all(), [
            'name' => 'required|min:3|max:30',
            'active' => 'required|boolean',
            // 'role_name' => 'required',
            'email' => 'required'
        ]);

        if (!$validator->fails()) {

            $user->name = $request->get('name');
            $user->active = $request->get('active');
            $user->email = $request->get('email');
            // DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            // DB::table('model_has_roles')->insert([
            //     'role_id'=>$request->get('role_name'),
            //     'model_id'=>$user->id,
            //     'model_type'=>'User'
            // ]);
            // $user ->assignRole($request->get('role_name'));

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
        $this->authorize('delete', $user);

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


