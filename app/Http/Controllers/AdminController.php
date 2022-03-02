<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Dotenv\Validator;
use App\Mail\welcomeEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('ViewAny', Admin::class);
        $users_type = Role::all();
        $roles =DB::table('model_has_roles')->pluck('role_id',)->all();
        $admins = Admin::where('id','!=',auth('admin')->id())->get();
        return view('cms.admins.index',['admins'=>$admins,'roles'=>$roles ,'users_type'=>$users_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Admin::class);
        $roles = Role::all();

        return view('cms.admins.create',compact('roles',$roles));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Admin::class);

        $validator=Validator($request->all(),[
            'name'=>'required|min:3|max:30',
            'active'=>'required|boolean',
            'role_name' => 'required',
            'email'=>'required|email|unique:admins,email',
        ]);

        if(!$validator->fails()){
            $admin=new Admin();
            $admin->name=$request->get('name');
            $admin->active=$request->get('active');
            $admin->email=$request->get('email');
            $isSaved=$admin->save();
            $admin ->assignRole($request->get('role_name'));
            event(new Registered($admin));

            // DB::table('model_has_roles')->insert([
            //     'role_id' => $request->get('role_name'),
            //     'model_id' => $admin->id,
            //     'model_type' => 'Admin',
            //     // 'model_type' => get_class($admin),
            // ]);
            // Mail::to($admin->email)->send(new welcomeEmail($admin));
            return response()->json([
                'message'=>$isSaved ?" admin Saved Successfuly" : "Failed to Saved"],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $this->authorize('update', $admin);
        $roles = Role::all();
        // $roles = Role::pluck('name','name')->all();
        // $adminRole = $admin->roles->pluck('name','name')->all();

        return view('cms.admins.edit',['admin'=>$admin,'roles'=>$roles ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $this->authorize('update', $admin);

        $validator=Validator($request->all(),[
            'name'=>'required|min:3|max:30',
            'active'=>'required|boolean',
            'role_name' => 'required',
            'email'=>'required'
        ]);
        if(!$validator->fails()){

            $admin->name=$request->get('name');
            $admin->active=$request->get('active');
            $admin->email=$request->get('email');
            DB::table('model_has_roles')->where('model_id',$admin->id)->delete();
            $admin ->assignRole($request->get('role_name'));

            $isUpdated=$admin->save();
            // DB::table('model_has_roles')->insert([
            //     'role_id' => $request->get('role_name'),
            //     'model_id' => $admin->id,
            //     'model_type' => get_class($admin),
            // ]);

            return response()->json([
                'message'=>$isUpdated ?" Admin Updated Successfuly" : "Failed to Update"],
                $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->authorize('delete', $admin);
        $isDeleted = $admin->delete();

        if($isDeleted){
            return response()->json([
                'title'=>'Success' , 'text'=>'Admin Deleted Successfuly' , 'icon'=>'success'
            ],Response::HTTP_OK);
        }else{

            return response()->json([
                'title'=>'Failde' , 'text'=>'Admin Delete Failde' , 'icon'=>'error'
            ],Response::HTTP_BAD_REQUEST);

        }


    }
}
