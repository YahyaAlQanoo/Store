<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $repository = new CartModelRepository();
        // $items = $repository->get();

        // dd($this->cart->get());
        // dd($this->cart->get());
        

        return view('front.cart',[
            'cart' => $this->cart,
        ]);
    }
    public function show()
    {
        dd('yygh');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('jnsd');
        $request->validate([
            'product_id' => ['required','int','exists:products,id'],
            'quantity' => ['nullable','int','min:1'],
        ]);
        // dd($request);

        $product = Product::findOrFail($request->post('product_id'));
        // $repository = new CartModelRepository();
        // $repository->add($product, $request->post('quantity'));

        $this->cart->add($product, $request->post('quantity'));

        if($request->expectsJson()) {
            return response()->json([
                'message' => 'Item added to cart',
            ], 201);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Product Added To Cart!');
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
        // dd($id);
        $request->validate([
            // 'product_id' => ['required','int','exists:products,id'],
            'quantity' => ['required','int','min:1'],
        ]);

        // $product = Product::findOrFail($request->post('product_id'));
        // $repository = new CartModelRepository();
        // $repository->update($product, $request->post('quantity'));

        $this->cart->update($id, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cart->delete($id);
        return [
            'message' => 'Item Deleted',
        ];
    }
}
