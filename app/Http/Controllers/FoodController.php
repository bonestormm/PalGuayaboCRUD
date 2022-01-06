<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$foods = Food::paginate();

        $foods = DB::table('comidas')
            ->join('menus', 'comidas.id_menu', '=', 'menus.id')
            ->select(
                'comidas.id as id',
                'comidas.name as name',
                'comidas.description as description',
                'comidas.price as price',
                'comidas.image as image',
                'menus.name as menuName'
            )
            ->orderBy('menuName')
            ->paginate(10);

        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = DB::table('menus')
            ->select('id','name')
            ->get();
        
        return view('food.menu')->with('menus', $menus);
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
            'menu' => ['required', 'integer', 'min: 0'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
        ]);


        $food = Food::create([
            'id_menu' => $request->menu,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if ($request->hasFile('image')) {
            $image = request()->file('image')->getClientOriginalName();
            $extension = request()->file('image')->getClientOriginalExtension();
            $name = $request->name;

            $request->file('image')->storeAs('public/images', $food->id . '/' . $image, '');
            $food->update(['image' => $image]);
        } else {
            return redirect(RouteServiceProvider::EDITFOODS)->withError('Adjunte todos los datos hp');
        }

        return redirect(RouteServiceProvider::EDITFOODS)->withSuccess('Comida ' . $request->name . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = DB::table('comidas')
            ->select('*')
            ->where('id', $id)
            ->get();
        $menus = DB::table('menus')
            ->select('id','name')
            ->get();
        return view('food.editFood')->with('menus', $menu);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
