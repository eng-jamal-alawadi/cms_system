<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('cms.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40'
        ]);
        City::create([
            'name' => $request->name
        ]);
        $cities = City::get();

        return redirect()->route('cities.index',compact('cities'))->with('success','Ctiy created successfuly');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('cms.cities.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request ->validate([
            'name'=>'required|min:3|max:40'
        ]);
        City::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('cities.index')->with('success','Ctiy Updated successfuly');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        // City::findOrFail($id)->delete();
        // return redirect()->back();

        $isDeleted = $city->delete();
        if($isDeleted){
            return response()->json([
                'title'=>'Success' , 'text'=>'City Deleted Successfuly' , 'icon'=>'success'
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'title'=>'Failde' , 'text'=>'City Delete Failde' , 'icon'=>'error'
            ],Response::HTTP_BAD_REQUEST);
        }

    }
}