<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('cms.spatie.permissions.index', compact('permissions', $permissions));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.spatie.permissions.create');

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
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->guard_name = $request->guard_name;
            $isSave = $permission->save();
            if ($isSave) {
                return response()->json([
                    'message' => 'Permission created successfully'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Permission not created'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => 'Permission not created'
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
    public function edit(Permission $permission)
    {
        $guards = ['admin', 'user'];
        return view('cms.spatie.permissions.edit', ['permission' => $permission, 'guards' => $guards]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'guard_name' => 'required|string|in:admin,user',
        ]);
        if (!$validator->fails()) {

            $permission->name = $request->name;
            $permission->guard_name = $request->guard_name;
            $isUpdate = $permission->save();
            if ($isUpdate) {
                return response()->json([
                    'message' => 'permission Updated successfully'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'permission not Updated'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => 'permission not Updated'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $isDeleted = $permission->delete();

        if ($isDeleted) {
            return response()->json([
                'title' => 'Success', 'text' => 'Permission Deleted Successfuly', 'icon' => 'success'
            ], Response::HTTP_OK);
        } else {

            return response()->json([
                'title' => 'Failde', 'text' => 'Permission Delete Failde', 'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
