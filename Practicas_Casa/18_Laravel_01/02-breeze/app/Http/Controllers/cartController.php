<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOffer;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Auth;

//TODO meter buscadores en productos de crear oferta, buscador en fechas de pedidos, linkx cabecera, nuevo offerta = nuevo producto, mensajes flash, borrar linea en carrito, agregar producto a carrito te lleve al home (flash)
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

        return redirect()->route("cartShow");
    }

    public function cartAddOne($productOfferId)
    {
        $carrito = session()->get("carrito", []);
        $productOffer = ProductOffer::findOrFail($productOfferId);
        $offerId = $productOffer->offer_id;

        if (isset($carrito[$offerId])) {
            if (isset($carrito[$offerId][$productOfferId])) {
                $carrito[$offerId][$productOfferId]++;
            }
        }

        session()->put("carrito", $carrito);

        return redirect()->route("cartShow");
    }


    public function cartRemoveOne($productOfferId)
    {
        $carrito = session()->get("carrito", []);
        $productOffer = ProductOffer::findOrFail($productOfferId);
        $offerId = $productOffer->offer_id;

        if (isset($carrito[$offerId])) {
            if (isset($carrito[$offerId][$productOfferId])) {
                $carrito[$offerId][$productOfferId]--;
            }
        }

        session()->put("carrito", $carrito);

        return redirect()->route("cartShow");
    }

    public function cartOrder()
    {
        $carrito = session('carrito', []);
        $total = 0;
        $order = Order::create([
            "user_id" => Auth::id(),
            "total" => $total
        ]);

        foreach ($carrito as $offerId => $productos) {
            foreach ($productos as $productId => $cantidad) {
                $producto = Product::findOrFail($productId);
                $total += $producto->price * $cantidad;
                ProductOrder::create([
                    "order_id" => $order->id,
                    "product_id" => $producto->id,
                    "quantity" => $cantidad
                ]);
            }
        }

        $order->total = $total;
        $order->save();

        $this->cartClear();

        return redirect()->route("home_prieto");
    }
}
