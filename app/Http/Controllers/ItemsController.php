<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('items.create', compact('categories'));
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
            'category_id' => 'required',
            'name'        => 'required',
            'description' => 'required',
            'cost'        => 'required'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();

        $item = Item::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'cost' => $request->input('cost'),
            'image_type' => $extension
        ]);

        $storage = Storage::disk('s3')->put(
            '/items/' . $item->id .  '.' . $extension,
            file_get_contents( $request->file('image')->getRealPath() ),
            'public'
        );

        return redirect('items')->with('flash_message', 'New Item added: ' . $item->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('store.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();

        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required',
            'description' => 'required',
            'cost'        => 'required'
        ]);

        $item = Item::find($id);

        $item->category_id = $request->input('category_id');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->cost = $request->input('cost');

        if ($request->hasFile('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();

            $item->image_type = $extension;

            $storage = Storage::disk('s3')->put(
                '/items/' . $item->id .  '.' . $extension,
                file_get_contents( $request->file('image')->getRealPath() ),
                'public'
            );
        }

        $item->save();

        return redirect('items')->with('flash_message', 'Item details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);

        return redirect('items');
    }
}
