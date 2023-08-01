<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLanguagesStoreRequest;
use App\Http\Requests\AdminLanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLanguagesStoreRequest $request)
    {

        $lang = new Language();
        $lang->name = $request->name;
        $lang->lang = $request->lang;
        $lang->slug = $request->slug;
        $lang->default = $request->default;
        $lang->status = $request->status;
        $lang->save();

        toast(__('Language Created Successfully!'), 'success')->width(350);


        return redirect()->route('admin.language.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = Language::findOrFail($id);

        return view('admin.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminLanguageUpdateRequest $request, string $id)
    {
        $lang = Language::findOrFail($id);
        $lang->name = $request->name;
        $lang->lang = $request->lang;
        $lang->slug = $request->slug;
        $lang->default = $request->default;
        $lang->status = $request->status;
        $lang->save();

        toast(__('Language Updated Successfully!'), 'success')->width(350);


        return redirect()->route('admin.language.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lang = Language::findOrFail($id);
            if($lang->lang === 'en') {
                return response(['status' => 'error', 'message' => __('Cant Delete This One!')]);
            }
            $lang->delete();
            return response(['status' => 'success', 'message' => __('Deleted Successfully!')]);
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'message' => __('something went wrong!')]);
        }
    }
}