<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\orders;
use App\Models\orders_items;
use Illuminate\Support\Facades\Auth;


class cartController extends Controller
{
    public function cartShow()
    {
        $productos = session("carrito", []);
        //dd($productos);
        return view("carrito", compact("productos"));
    }

    public function cartAdd($productID)
    {
        //CARRITO SESSION FUNCIONAL
        $carrito = session('carrito', []);

        if (isset($carrito[$productID])) {
            $carrito[$productID]["cantidad"]++;
        } else {
            $producto = Products::findOrFail($productID);
            $carrito[$productID] = [
                "nombre"   => $producto->name,
                "cantidad" => 1,
                "imagen"   => $producto->image,
                "precio"   => $producto->price,
            ];

            session(['carrito' => $carrito]);
        };



        return redirect()->route("cartShow");
    }

    public function cartRemove($productID)
    {
        $carrito = session("carrito", []);
        if (isset($carrito[$productID])) {
            unset($carrito[$productID]);
            error_log("Producto eliminado => " . $productID);
        } else {
            error_log("No deberia no estar");
        }
        session()->put("carrito", $carrito);

        return redirect()->route("cartShow");
    }

    public function cartClear()
    {
        session()->forget("carrito");

        return redirect()->route("cartShow");
    }

    public function cartAddOne($productID)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$productID])) {
            $carrito[$productID]["cantidad"]++;
        };
        session(['carrito' => $carrito]);
        return redirect()->route("cartShow");
    }


    public function cartRemoveOne($productID)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$productID]) && $carrito[$productID]["cantidad"] > 1) {
            $carrito[$productID]["cantidad"]--;
        };
        session(['carrito' => $carrito]);
        return redirect()->route("cartShow");
    }

    public function cartOrder()
    {
        $productos = session('carrito', []);

        $total = 0;
        foreach ($productos as $id => $producto) {
            $total += $producto["precio"] * $producto["cantidad"];
        }

        $order = orders::create([
            "user_id" => Auth::id(),
            "status" => "Reservado",
            "total" => $total
        ]);

        foreach ($productos as $id => $producto) {

            orders_items::create([
                "order_id" => $order->id,
                "product_id" => $id,
                "quantity" => $producto["cantidad"],
                "unit_price" => $producto["precio"],
            ]);
        }

        $this->cartClear();
        return redirect()->route("home_prieto");
    }
}
