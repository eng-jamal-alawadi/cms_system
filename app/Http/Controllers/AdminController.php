<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Dotenv\Validator;
use App\Mail\welcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('cms.admins.index',compact('admins',$admins));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator=Validator($request->all(),[
            'name'=>'required|min:3|max:30',
            'active'=>'required|boolean',
            'email'=>'required'
        ]);

        if(!$validator->fails()){
            $admin=new Admin();
            $admin->name=$request->get('name');
            $admin->active=$request->get('active');
            $admin->email=$request->get('email');
            $isSaved=$admin->save();

            Mail::to($admin->email)->send(new welcomeEmail($admin));
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
        return view('cms.admins.edit',compact('admin',$admin));
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
        $validator=Validator($request->all(),[
            'name'=>'required|min:3|max:30',
            'active'=>'required|boolean',
            'email'=>'required'
        ]);

        if(!$validator->fails()){

            $admin->name=$request->get('name');
            $admin->active=$request->get('active');
            $admin->email=$request->get('email');
            $isUpdated=$admin->save();
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
