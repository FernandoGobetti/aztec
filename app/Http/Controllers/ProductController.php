<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Shopping;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Route::get /api/listacompras/{id}/products
     * Lista somente os produtos de uma lista de compra.
     *
     * @param int $listacompra
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index(int $listacompra)
    {
        $shoppingList = Shopping::with('products')->find($listacompra);
        if ($shoppingList === null) {
            return response()->json(['message' => 'Lista de compras não encontrada.'], 404);
        }

        return $shoppingList->products;
    }

    /**
     * Route::post /api/listacompras/{listacompra}/products
     * Lista somente os produtos de uma lista de compra.
     *
     * @param ProductRequest $request
     * @param int $listacompra
     */
    public function addproductlist(ProductRequest $request, int $listacompra)
    {
        $shoppingList = Shopping::find($listacompra);
        if ($shoppingList === null) {
            return response()->json(['message' => 'Lista de compras não encontrada.'], 404);
        }
        // tem que verificar se já não tem algum cadastrado.
        if ($shoppingList->products()->whereName($request->name)->get()->count()) {
            return response()->json(['message' => 'Item já cadastrado na lista.'], 404);
        }

        $product = $shoppingList->products()->create($request->all());

        return $product;
    }

    /**
     * Route::delete /api/listacompras/{listacompra}/products/{product}
     * Lista somente os produtos de uma lista de compra.
     *
     * @param int $listacompra
     * @param ProductRequest $request
     */
    public function deleteproductlist(int $listacompra, int $product)
    {
        Product::destroy($product);
        return response()->noContent();
    }

    /**
     * Route::patch /api/listacompras/{listacompra}/products/{product}
     * Lista somente os produtos de uma lista de compra.
     *
     * @param int $listacompra
     * @param Product $product
     */
    public function changeQtyProduct(Product $product, Request $request)
    {
        if (isset($request->action)) {
            if ($request->action == "raise") {
                $product->qty += $request->qty;
                $product->save();
            } else if ($request->action == "reduce") {
                $product->qty -= $request->qty;
                $product->save();
            }
        }
        return $product;
    }
}
