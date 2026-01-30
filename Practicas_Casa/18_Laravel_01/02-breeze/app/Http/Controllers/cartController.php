<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\orders;
use App\Models\orders_items;
use App\Models\ProductOffer;
use Illuminate\Support\Facades\Auth;


class cartController extends Controller
{
    public function cartShow()
    {
        $carrito = session("carrito", []);

        $offerIds = array_keys($carrito);


        $productOfferId = [];
        foreach ($carrito as $offerId => $items) {
            $productOfferId = array_merge($productOfferId, array_keys($items));
        }

        $productOfferId = array_unique($productOfferId);
        // dd($offerIds);
        $offersById = Offer::whereIn("id", $offerIds)
            ->get()
            ->keyBy("id");

        $productsOffersById = ProductOffer::with("product")
            ->whereIn("id", $productOfferId)
            ->get()
            ->keyBy("id");


        // dd($carrito);
        // dd($offersById);
        // dd($productsOffersById[3]);

        return view("carrito", compact("carrito", "offersById", "productsOffersById"));
    }

    public function cartAdd($productOfferId)
    {
        //session()->forget("carrito");
        $carrito = session()->get("carrito", []);
        $productOffer = ProductOffer::findOrFail($productOfferId);
        $offerId = $productOffer->offer_id;

        if (isset($carrito[$offerId])) {
            if (isset($carrito[$offerId][$productOfferId])) {
                $carrito[$offerId][$productOfferId]++;
            } else {

                $carrito[$offerId][$productOfferId] = 1;
                error_log("NO reconoce que existe 1");
            }
        } else {

            error_log("NO reconoce que existe LA OFERTA");
            $nuevoProducto = [$productOfferId => 1];

            $carrito[$offerId] = $nuevoProducto;
        }

        session()->put("carrito", $carrito);

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

        return redirect()->route("mostrar");
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
