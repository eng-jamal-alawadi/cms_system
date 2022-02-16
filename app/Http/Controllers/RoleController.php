<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('cms.spatie.roles.index', compact('roles', $roles));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.spatie.roles.create');
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
            'name' => 'required|string|min:3|max:50',
            'guard_name' => 'required|string|in:admin,user',
        ]);
        if (!$validator->fails()) {
            $role = new Role();
            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $isSave = $role->save();
            if ($isSave) {
                return response()->json([
                    'message' => 'Role created successfully'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Role not created'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => 'Role not created'
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
    public function edit(Role $role)
    {
        $guards = ['admin', 'user'];
        return view('cms.spatie.roles.edit', ['role' => $role, 'guards' => $guards]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'guard_name' => 'required|string|in:admin,user',
        ]);
        if (!$validator->fails()) {

            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $isUpdate = $role->save();
            if ($isUpdate) {
                return response()->json([
                    'message' => 'Role Updated successfully'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Role not Updated'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => 'Role not Updated'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $isDeleted = $role->delete();

        if ($isDeleted) {
            return response()->json([
                'title' => 'Success', 'text' => 'Role Deleted Successfuly', 'icon' => 'success'
            ], Response::HTTP_OK);
        } else {

            return response()->json([
                'title' => 'Failde', 'text' => 'Role Delete Failde', 'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
