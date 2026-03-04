<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductOffer;
use App\Models\Offer;
use App\Models\ProductOrder;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //
    /*
            cart = [
                offer_id => [
                    productOffer_id => quantity
                ]
            ];

            cart = [
                10 => [ // offer_id = 10
                    101 => 2, // productOffer_id 101, cantidad 2
                    102 => 1
                ],
                12 => [ // offer_id = 12
                    150 => 1,
                    151 => 3
                ]
            ];


    */

    public function index()
    {
        $cart = session()->get('cart', []);

        $offersIds=array_keys($cart);//conseguimos un array de id de ofertas y productos-oferta, este sin duplicados
        //dd($offersIds);
        $productOffersIds=[];

        foreach($cart as $offId=>$items){

            $productOffersIds=array_merge($productOffersIds,array_keys($items));
        }
        $productOffersIds=array_unique($productOffersIds);

        //dd($productOffersIds);
        /*
                The keyBy method keys the collection by the given key.
                If multiple items have the same key, only the last one will appear in the new collection:
        */
        //dd($cart);
        $offersById=Offer::whereIn('id',$offersIds)->get(['id','date_delivery','time_delivery'])->keyBy('id');

        $productOffersById=ProductOffer::with('product') ->whereIn ('id',$productOffersIds) ->get(['id','offer_id','product_id'])->keyBy('id');

        return view('cart.index',compact('cart','offersById','productOffersById'));
    }


    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $idProduct = (int)$id;
        // si el producto ya esta en el carrito, incrementamos su cantidad
        if (isset($cart[$idProduct])) {
            $cart[$id]['quantity']++;
        } else {
            // si no esta el producto en el carrito lo agregamos

            $cart[$idProduct] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('succes', 'Producto añadido al carrito');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        $idProduct = (int)$id;
        //si el producto existe en el carrito lo eliminamos
        if (isset($cart[$idProduct])) {
            unset($cart[$idProduct]); //elimina una variable o un elemento específico de un array
            // actualizamos el carrito
            session()->put('cart', $cart);
        }
        //redireccionar al carrito con mensaje de exito
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    public function clear()
    {
        session()->forget('cart'); //elimina una variable de la sesión
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);
        $idProduct = (int)$id;
        if (isset($cart[$idProduct])) {
            $cart[$idProduct]['quantity']++;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Cantidad incrementada');
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        $idProduct = (int)$id;

        if (isset($cart[$idProduct]) && $cart[$idProduct]['quantity'] > 1) {
            $cart[$idProduct]['quantity']--;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Cantidad decrementada');
    }

    public function order()
    {
        //aqui iria la logica para procesar el pedido (guardar en base de datos, enviar email, etc)
        $cart = session()->get('cart', []); //guardamos el carrito en una variable

        //si el carrito esta vacio, redirigimos con un mensaje de error
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }


        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => 0
        ]);

        $precioTotal = 0;

        foreach ($cart as $key => $product) {
            $precioTotal += $product["quantity"] * $product["price"];
            ProductOrder::create([
                "order_id" => $order->id,
                "product_id" => $key,
                "quantity" => $product["quantity"]
            ]);
        }

        $order->total = $precioTotal;
        $order->save();

        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Pedido realizado con éxito!!');
    }

    public function orders()
    {
        // Busca pedidos del usuario y carga "en cascada" sus líneas (order_items) y los datos de cada producto (product) para evitar múltiples consultas a la BD.
        $orders = Order::where('user_id', Auth::id())->with('order_items.product')->get();//
        return view('cart.orders', compact('orders'));
    }
}
