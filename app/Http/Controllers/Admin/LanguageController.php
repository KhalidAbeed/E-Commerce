<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

use App\Http\Requests\Languagerequest;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages=Language::paginate(PAGINATION_COUNT);
        return view('admin.languages.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Languagerequest $request)
    {
        try{
            Language::create($request->all());
            return redirect()->route('languages.all')->with(['success' => 'تم حفظ اللغة بنجاح']);
        }
        catch(\Exception $e){
            return redirect()->route('languages.all')->with(['error' => 'هناك خطا يرجي المحاولة لاحقا ']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language=Language::find($id);
        return view('admin.languages.edit',compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Languagerequest $request, $id)
    {

        try{
            $language=Language::find($id);
            if(!$request->has('active'))
            {
                $request->request->add(['active' => 0]);
            }else{
                $request->request->add(['active' => 1]);
            }

            $language->update($request->all());
            return redirect()->route('languages.all')->with(['success' => 'تم تحديث اللغة بنجاح']);
        }
        catch(\Exception $e){
            return redirect()->route('languages.all')->with(['error' => 'هناك خطا يرجي المحاولة لاحقا ']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $language=Language::find($id);
            $language->delete();
            return redirect()->route('languages.all')->with(['success' => 'تم حذف اللغة بنجاح']);
        }
        catch(\Exception $e){
            return redirect()->route('languages.all')->with(['error' => 'هناك خطا يرجي المحاولة لاحقا ']);
        }
    }
}
