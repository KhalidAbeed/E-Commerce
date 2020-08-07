<?php
namespace App\Http\Controllers\Admin;
//use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Maincategory;
use Illuminate\Http\Request;
use DB;

class MaincategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language=get_default_language();
        $categories=Maincategory::where('translation_lang',$language)->selection()->get();
        return view('admin.maincategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.maincategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
        //return $request;
        // try{
        //     DB::beginTransaction();
            $filepath="";
            if($request->hasfile('photo'))
            {
                //$filepath=saveimage($request->photo,'maincategories');
                $filepath=uploadimage('maincategories',$request->photo);
            }

            $main_categories=collect($request->category);
    ######################### Default Language Category #############################
            $main_category=$main_categories->filter(function($value,$key){
                return $value['abbr'] == get_default_language();
            });

            $default_category=array_values($main_category->all())[0];

            $default_category_id=Maincategory::insertGetId([
                'translation_lang'=> $default_category['abbr'],
                'translation_off'=>0,
                'name'=> $default_category['name'],
                'photo'=> $filepath,
                'slug'=> $default_category['name'],

            ]);

    ######################### other Languages Categories #############################
            $categories=$main_categories->filter(function($value,$key){
                return $value['abbr'] != get_default_language();
            });

            if(isset($categories) && $categories->count() > 0)
            {
                $all=[];
                foreach($categories as $category)
                {
                    $all[]=[
                        'translation_lang'=> $category['abbr'],
                        'translation_off'=>$default_category_id,
                        'name'=> $category['name'],
                        'photo'=> $filepath,
                        'slug'=> $category['name'],
                    ];
                }
                Maincategory::insert($all);
           }
        //     DB::commit();
             return redirect()->route('Maincategories.all')->with(['success' => 'تم الحفظ بنجاح']);
        // }catch(\Exception $e){
        //     DB::rollback();
        //     return redirect()->route('Maincategories.all')->with(['error' => 'هناك خطأ ما يرجي المحاولة فيما بعد ']);
        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maincategory  $maincategory
     * @return \Illuminate\Http\Response
     */
    public function show(Maincategory $maincategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maincategory  $maincategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category=Maincategory::with('categories')->find($id);
        if(!$category)
        {
            return redirect()->route('Maincategories.all')->with(['error' => 'هذا المنتج غير موجود']);
        }

        return view('admin.maincategories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maincategory  $maincategory
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {


        $category=Maincategory::find($id);
        if(!$category)
        {
            return redirect()->route('Maincategories.all')->with(['error' => 'هذا المنتج غير موجود']);
        }
        $cat=array_values($request->category)[0];

        if(!$request->has('category.0.active'))
        {
            $request->request->add(['active' => 0]);
        }else{
            $request->request->add(['active' => 1]);
        }
        $category->update([
            'name' => $cat['name'],
            'active'=>$request->active
        ]);

        if($request->has('photo'))
        {
            $filepath=uploadimage('maincategories',$request->photo);
            $category->update([
                'photo' => $filepath,
            ]);
        }
        return redirect()->route('Maincategories.all')->with(['success' => 'تم التحديث بنجاح']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maincategory  $maincategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maincategory $maincategory)
    {
        //
    }
}
