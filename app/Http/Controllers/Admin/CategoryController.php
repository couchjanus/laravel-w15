<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\CategoryEnumStatusType;
use App\Http\Requests\UpdatedCategoriesRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $categories = Category::paginate(10);
        $order = isset($request->order)?$request->order:'desc';
        $breadcrumbItem = 'Categories';
        $title = 'Categories Management';
        $status = CategoryEnumStatusType::toSelectArray();
        return view('admin.categories.index',compact('categories', 'order', 'title', 'breadcrumbItem', 'status'));
    }
    
    public function getCategoriesByStatus(Request $request)
    {
        $status = CategoryEnumStatusType::toSelectArray();
        $statusCategory = $request->status;
        $categories = Category::status($statusCategory)->paginate(5);
        $breadcrumbItem = 'Categories Status';
        $title = 'Categories Management';
        return view('admin.categories.index', compact('categories', 'status', 'statusCategory', 'title', 'breadcrumbItem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbItem = 'New Category';
        $status = CategoryEnumStatusType::toSelectArray();
        return view('admin.categories.create', compact('breadcrumbItem', 'status'))->withTitle('Add New Category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|string',
        ]);

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|unique:categories|max:255',
        //     'description' => 'nullable|string',
        // ])->validate();

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|unique:categories|max:255|min:3',
        //     'description' => 'nullable|string',
        // ]);
        
        // Переданные данные не прошли проверку
        // if ($validator->fails()) {
        //     return redirect('admin/categories/create')
        //             ->withErrors($validator)
        //             ->withInput();
        // }

        // $validator->after(function ($validator) {
        //     if ($this->somethingElseIsInvalid()) {
        //         $validator->errors()->add('name', 'Something is wrong with this field!');
        //     }
        // });
 
        Category::create($request->all());
        return redirect(route('admin.categories.index'))->with('success', 'Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $breadcrumbItem = 'Edit Category';
        $status = CategoryEnumStatusType::toSelectArray();
        return view('admin.categories.edit', compact('breadcrumbItem', 'status', 'category'))->withTitle('Edit Category');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedCategoriesRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
