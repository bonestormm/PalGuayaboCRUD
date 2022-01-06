<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Exception;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate();

        //return view('users.index', compact('users'));
        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.menu');
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);


        $menu = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('image')) {
            $image = request()->file('image')->getClientOriginalName();
            $extension = request()->file('image')->getClientOriginalExtension();
            $name = $request->name;

            $request->file('image')->storeAs('public/images/menus', $menu->id . '/' . $image, '');
            $menu->update(['image' => $image]);
        } else {
            return redirect(RouteServiceProvider::EDITMENU)->withError('Adjunte todos los datos hp');
        }

        return redirect(RouteServiceProvider::EDITMENU)->withSuccess('Menú ' . $request->name . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = DB::table('menus')
            ->select('*')
            ->where('id', $id)
            ->get();
        return view('menu.showMenu')->with('menus', $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = DB::table('menus')
            ->select('*')
            ->where('id', $id)
            ->get();

        return view('menu.editMenu')->with('menus', $menu);
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->description = $request->description;
        $destination = 'images/' . $menu->id . '/';

        if ($request->hasFile('image')) {
            $image = request()->file('image')->getClientOriginalName();
            $image_path = 'images/' . $menu->id . '/' . $image . '/' . $menu->image;

            // Get all files in a directory
            $files =   Storage::allFiles('public/images/menus' . $menu->id);

            // Delete Files
            Storage::delete($files);

            $request->file('image')->storeAs('public/images/menus', $menu->id . '/' . $image, '');
            $menu->update(['image' => $image]);
        }

        $menu->save();

        return back()->withSuccess('Menú ' . $request->name . ' editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        Storage::deleteDirectory('public/images/menus' . $menu->id);
        return back()->withSuccess('Menú ' . $menu->name . ' borrado correctamente.');
    }
}
