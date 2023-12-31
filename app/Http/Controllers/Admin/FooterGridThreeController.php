<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterGridThree;
use App\Models\FooterTitle;
use App\Models\Language;
use Illuminate\Http\Request;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.footer-grid-three.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();

        return view('admin.footer-grid-three.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $footer = new FooterGridThree();
        $footer->language = $request->language;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toast(__('Created Successfully!'), 'success');

        return redirect()->route('admin.footer-grid-three.index');
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
        $footerGridThree = FooterGridThree::findOrFail($id);
        $languages = Language::all();
        return view('admin.footer-grid-three.edit', compact('footerGridThree', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        $footer->language = $request->language;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toast(__('Updated Successfully!'), 'success');

        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterGridThree::findOrFail($id);

        $footer->delete();

        return response(['status' => 'success', 'message' => __('Deleted Successfully!')]);
    }

    public function handleTitle(Request $request)
    {
        $request->validate([
           'title' => 'required|max:255'
        ]);


        FooterTitle::updateOrCreate(
            [
               'key' => 'grid_three_title',
               'language' => $request->language
            ],
            [
               'value' => $request->title
            ]
        );

        toast(__('Updated Successfully!'), 'success');

        return redirect()->back();
    }
}