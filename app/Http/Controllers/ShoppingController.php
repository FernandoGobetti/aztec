<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingRequest;
use Illuminate\Http\Request;
use App\Models\Shopping;

class ShoppingController extends Controller
{
    /**
     * Route::get /api/listacompras
     *
     * Lista todas as "Listas de compras", cadastradas no banco.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $shoppingList = Shopping::all();

        return $shoppingList;
    }

    /**
     * Route::post /api/listacompras/create
     *
     * Adiciona uma nova lista de compras.
     *
     */
    public function store(ShoppingRequest $request)
    {
        return response()->json(Shopping::create($request->all()), 201);
    }

    /**
     * Route::get /api/listacompras/{id}
     *
     * Lista somente uma lista de comrpas.
     *
     * @param int $listacompra
     */
    public function show(int $listacompra)
    {
        $shoppingList = Shopping::with('products')->find($listacompra);
        if ($shoppingList === null) {
            return response()->json(['message' => 'Lista de compras não encontrada.'], 404);
        }

        return $shoppingList;
    }

    /**
     * Route::put /api/listacompras/{id}
     *
     * Altera os dados de uma lista de compras.
     *
     * @param Shopping $listacompra
     * @param ShoppingRequest $request
     */
    public function update(Shopping $listacompra, ShoppingRequest $request)
    {
        $listacompra->fill($request->all());
        $listacompra->save();
        return $listacompra;
    }

    /**
     * Route::delete /api/listacompras/{id}
     *
     * Deleta uma lista de compras
     *
     * @param int $listacompra
     */
    public function destroy(int $listacompra)
    {
        Shopping::destroy($listacompra);
        return response()->noContent();
    }

    /**
     * Route::post /api/listacompras/{listacompra}/duplicate
     *
     * @param Shopping $listacompra
     */
    public function duplicate(Shopping $listacompra)
    {
        $newList = $listacompra->toArray();
        $newList['name'] = $newList['name'] . "-Duplicated";
        unset($newList['updated_at']);
        unset($newList['created_at']);

        return response()->json(Shopping::create($newList), 201);
    }
}
