<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Front\Interfaces\CartRepositoryInterface;
use App\Repositories\Front\Interfaces\CatalogueRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cartRepository;
    private $catalogueRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartRepositoryInterface $cartRepository, CatalogueRepositoryInterface $catalogueRepository)
    {
        parent::__construct();

        $this->cartRepository = $cartRepository;
        $this->catalogueRepository = $catalogueRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['items'] = $this->cartRepository->getContent();

        return $this->loadTheme('cart.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');

        $product = $this->catalogueRepository->findProductByID($params['product_id']);
        $slug = $product->slug;

        $attributes = [];
        if ($product->configurable()) {
            $product = $this->catalogueRepository->getProductbyAtrributes($product, $params);

            $attributes['size'] = $params['size'];
            $attributes['color'] = $params['color'];
        }

        $itemQuantity =  $this->cartRepository->getItemQuantity($product->id, $params['qty']);
        $this->catalogueRepository->checkProductInventory($product, $itemQuantity);

        $item = [
            'id' => md5($product->id),
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $params['qty'],
            'attributes' => $attributes,
            'associatedModel' => $product,
        ];

        $this->cartRepository->addItem($item);

        Session::flash('success', 'Product ' . $item['name'] . ' has been added to cart');
        return redirect('/product/' . $slug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');

        if ($items = $params['items']) {
            foreach ($items as $cartID => $item) {
                $cartItem = $this->cartRepository->getCartItem($cartID);
                $this->catalogueRepository->checkProductInventory($cartItem->associatedModel, $item['quantity']);
            }

            Session::flash('success', 'The cart has been updated');
            return redirect('carts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cartRepository->removeItem($id);

        return redirect('carts');
    }
}
