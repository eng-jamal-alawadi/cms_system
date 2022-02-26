<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //constructor magic function
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }



    public function index()
    {
        $this->authorize('ViewAny', Category::class);
        // $categories= Category::all();
        // $categories= auth('admin')->user()->categories;

        $guard = auth()->guard('admin')->check()? 'admin' : 'user';
        if($guard == 'admin'){
            $categories = Admin::find(auth()->guard('admin')->user()->id)->categories;
        }else{
            $categories = User::find(auth()->guard('user')->user()->id)->categories;
        }


        return response()->view('cms.categories.index',compact('categories',$categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        // $request->validate([
        //     'name'=>'required|min:3|max:30',
        //     'active'=>'required|boolean'
        // ]);

        // Category::create([
        //     'name'=>$request->name,
        //     'active'=>$request->active
        // ]);

        // return redirect()->route('categories.index')->with('success','Category Added Successfuly');

        //--------------------------------------------------------

        $validator=Validator($request->all(),[
            'name'=>'required|min:3|max:30',
            'active'=>'required|boolean',
            'category_image'=>'required|image|max:2048|mimes:jpg,png'
        ]);


        if(!$validator->fails()){
            // $category= auth('user')->user()->categories()->get();
            $ex = $request->file('category_image')->getClientOriginalExtension();
            $new_name = 'category_'.time().'_'.$ex;
            $request->file('category_image')->move(public_path('upload'),$new_name);

            $category=new Category();
            $category->name=$request->get('name');
            $category->active=$request->get('active');
            $category->image=$new_name;

            $guard = auth()->guard('admin')->check()? 'admin' : 'user';
            if($guard == 'admin'){
                // الطريقتين شغالات في الحالة الأولى والثانية بالإضافة لأنها تحتاج إلى تحديد المستخدم الذي سيتم إضافته إلى القائمة المختارة له
                    $isSaved = Admin::find(auth()->guard('admin')->user()->id)->categories()->save($category);
            // $isSaved = auth($guard)->user()->categories()->save($category);
            }else{
                $isSaved = User::find(auth()->guard('user')->user()->id)->categories()->save($category);
                // $isSaved = auth($guard)->user()->categories()->save($category);
            }


            // $ex = $request->file('category_image')->getClientOriginalExtension();
            // $new_name = 'category_'.time().'_'.$ex;
            // $request->file('category_image')->move(public_path('upload'),$new_name);

            // $category = User::find(auth('user')->user()->id)->categories()->create([
            //     'name'=>$request->name,
            //     'active'=>$request->active,
            //     'image'=>$new_name
            // ]);

            // $category->name=$request->get('name');
            // $category->active=$request->get('active');

            // $category->image=$new_name;


            $isSaved=$category->save();



            return response()->json([
                'message'=>$isSaved ?" category Saved Successfuly" : "Failed to Saved"],
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('update' , $category);
        return response()->view('cms.categories.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update' , $category);

        $validator=Validator($request->all(),[
            'name'=>'required|min:3|max:30',
            'active'=>'required|boolean'
        ]);

        if(!$validator->fails()){
            $category->name = $request->get('name');
            $category->active =$request->get('active');

            // $new_name = $category->image;

            // if($request->has('image')){
            //     $ex = $request->file('category_image')->getClientOriginalExtension();
            //     $new_name = 'category_'.time().'_'.$ex;
            //     $request->file('category_image')->move(public_path('upload'),$new_name);
            //     $category->image=$new_name;

            // }

            $isUpdated = $category->save();
            return response()->json([
                'message'=>$validator ? "Category Updated Successfuly" : "Failed to Updated"
            ],$isUpdated? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // $this->authorize('delete' , Category::class);
        $this->authorize('delete' , $category);


        $isDeleted = $category->delete();
        if($isDeleted){
            return response()->json([
                'title'=>'Success' , 'text'=>'Category Deleted Successfuly' , 'icon'=>'success'
            ],Response::HTTP_OK);
        }else{

            return response()->json([
                'title'=>'Failde' , 'text'=>'Category Delete Failde' , 'icon'=>'error'
            ],Response::HTTP_BAD_REQUEST);

        }
    }
}
