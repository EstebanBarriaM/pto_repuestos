<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::limit(4)->get();
        $products = Product::orderBy('id', 'desc')->limit(8)->get();

        return view('frontend.index', compact('categories', 'products'));
    }

    public function aboutUs()
    {
        return view('frontend.about_us');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function myAccountView()
    {
        $customer = auth()->user();

        return view('frontend.my_account', compact('customer'));
    }

    public function myAccountSave(Request $request)
    {
        $customer = User::find(auth()->id());

        $this->validate($request, [
            'full_name' => ['required', 'max:191'],
            'email' => ['required', 'email', 'unique:users,email,' . $customer->id],
            'password' => ['nullable', 'min:6']
        ]);

        $customer->update([
            'full_name' => $request->get('full_name'),
            'email' => $request->get('email')
        ]);

        if ($request->get('password')) {
            $customer->update([
                'password' => bcrypt($request->get('password'))
            ]);
        }

        return to_route('frontend.my_account.view')->with('success', 'Datos actualizados!');
    }

    public function cart()
    {
        $cart = session()->get('cart');

        return view('frontend.cart', compact('cart'));
    }

    public function clearCart()
    {
        session()->forget('cart');

        return to_route('frontend.cart')->with('success', 'Carrito vaciado exitosamente!');
    }

    public function addToCart(Request $request)
    {
        $id = $request->get('product_id');
        $product = Product::find($id);

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = ['products' => [], 'total' => 0];

            array_push($cart['products'], [
                'id' => $id,
                'photo' => $product->mainImage(),
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->get('quantity'),
                'subtotal' => $product->price * $request->get('quantity')
            ]);

            $cart['total'] = $product->price * $request->get('quantity');

            session()->put('cart', $cart);
            return to_route('frontend.cart')->with('success', 'Producto agregado exitosamente!');
        }

        // if cart not empty then check if this product exist then update quantity
        if (array_search($id, array_column($cart['products'], 'id')) !== false) {
            $cart['products'][array_search($id, array_column($cart['products'], 'id'))]['quantity'] += $request->get('quantity');
            $cart['products'][array_search($id, array_column($cart['products'], 'id'))]['subtotal'] = $product->price * $cart['products'][array_search($id, array_column($cart['products'], 'id'))]['quantity'];

            $cart['total'] += $product->price * $request->get('quantity');

            session()->put('cart', $cart);
            return to_route('frontend.cart')->with('success', 'Producto agregado exitosamente!');
        }

        // if item not exist in cart then add to cart
        $cart['products'][] = [
            'id' => $id,
            'photo' => $product->mainImage(),
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->get('quantity'),
            'subtotal' => $product->price * $request->get('quantity')
        ];

        $cart['total'] += $product->price * $request->get('quantity');

        session()->put('cart', $cart);

        return to_route('frontend.cart')->with('success', 'Producto agregado exitosamente!');
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        $order = Order::create([
            'total' => $cart['total'],
            'payment_method' => 'debit',
            'state' => 'paid',
            'user_id' => auth()->id()
        ]);

        foreach ($cart['products'] as $product) {
            OrderItem::create([
                'quantity' => $product['quantity'],
                'order_id' => $order->id,
                'product_id' => $product['id'],
            ]);

            $updateProduct = Product::find($product['id']);
            $updateProduct->stock -= $product['quantity'];
            $updateProduct->save();
        }

        session()->forget('cart');

        return to_route('frontend.cart')->with('success', 'Compra realizada exitosamente!');
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())->paginate(10);

        foreach ($orders as $order) {
            $items = [];

            foreach ($order->orderItems as $orderItem) {
                array_push($items, [
                    'product' => $orderItem->product->name,
                    'quantity' => $orderItem->quantity,
                    'price' => '$' . $orderItem->product->price
                ]);
            }

            $order['customer'] = $order->user->full_name;
            $order['items'] = $items;
        }

        return view('frontend.my_orders', compact('orders'));
    }
}
