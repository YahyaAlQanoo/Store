<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\Rules\File;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        // $query = Category::query();

        // if($name = $request->query('name')) {
        //     $query->where('name','LIKE',"%$name%");
        // }
        // if($status = $request->query('status')) {
        //     $query->where('status','=',"$status");
        // }

        // DB::table('categories')->leftjoin('categories as parent','parent.id','=','categories.parent_id')->select('categories.*','parent.name')->paginate();


        $categories = Category::with('parent')
        /*leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])*/
            ->withCount([
                'products as products_count' => function($query) {
                    $query->where('status','=','active');
                }
            ])
            ->filter($request->query())
            ->orderBy('categories.name')
            // ->withTrashed()
            // ->onlyTrashed()
            ->paginate();

            // $categories = Category::filter($request->query())
            // ->orderBy('name')
            // ->paginate(3);
        // $categories = $query->paginate(3);
        return view('dashboard.categories.index',compact('categories'));
    }



    /**
     *
     * Show the form for creating a new resource.
     *
     *@return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules(),[
            'name.required' =>'يا لطخ الاسم ممنوع يكون فارغ',
        ]);
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');
        $data['image']=$this->ImageUpload($request);

        Category::create($data);
        return redirect()->route('dashboard.categories.index')->with('success','Created Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',[
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id','<>',$id)
        ->where(function ($query) use($id) {
            $query->whereNull('parent_id')
            ->orwhere('parent_id','<>',$id);
        })->get();
        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
        *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // $request->validate(Category::rules($id));

        $category = Category::findOrFail($id);
        $old_image = $category->image;

        $data = $request->except('image');

        $new_image =$this->ImageUpload($request);
        if($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);

        if($old_image && $request->image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.categories.index')->with('update','Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // if($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        // Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('deleted','Category Deleted');
    }

    protected function ImageUpload(Request $request)
    {
        if(!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', [
                'disk' => 'public'
        ]);
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request,$id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
            ->with('success','Category Restore');
    }
    public function forcdelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')
            ->with('success','Category Deleted forever!');
    }
}
