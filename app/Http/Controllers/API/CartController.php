<?php

namespace App\Http\Controllers\API;

use App\Exceptions\OutOfStockException;
use App\Http\Controllers\API\BaseController;
use App\Repositories\Front\CatalogueRepository;
use App\Http\Resources\Item as ItemResource;
use Illuminate\Http\Request;
use App\Repositories\Front\Interfaces\CatalogueRepositoryInterface;
use App\Repositories\Front\Interfaces\CartRepositoryInterface;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Validator;

class CartController extends BaseController
{
    private $cartRepository;
    private $catalogueRepository;

    public function __construct(CartRepositoryInterface $cartRepository, CatalogueRepositoryInterface $catalogueRepository)
    {
        parent::__construct();
        $this->cartRepository = $cartRepository;
        $this->catalogueRepository = $catalogueRepository;
    }

    public function index(Request $request)
    {
        $items = $this->cartRepository->getContent($this->getSessionKey($request));

        $cart = [
            'items' => ItemResource::collection($items),
            'shipping_cost' => $this->cartRepository->getConditionValue('shipping_cost', $this->getSessionKey($request)),
            'tax_amount' => $this->cartRepository->getConditionValue('Tax 10%', $this->getSessionKey($request)),
            'total' => $this->cartRepository->getTotal($this->getSessionKey($request)),
        ];

        return $this->responseOk($cart, 200, 'Success');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => ['required', 'string'],
            'qty' => ['required', 'numeric'],
            'size' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Add item failed', 422, $validator->errors());
        }

        $params = $request->all();

        $product = $this->catalogueRepository->findBySKU($params['sku']);

        $attributes = [];
        if ($product->configurable()) {
            $product = $this->catalogueRepository->getProductbyAtrributes($product, $params);

            $attributes['size'] = $params['size'];
            $attributes['color'] = $params['color'];

            $itemQuantity = $this->cartRepository->getItemQuantity($product->id, $params['qty']);

            try {
                $this->catalogueRepository->checkProductInventory($product, $itemQuantity);
                $item = [
                    'id' => md5($product->id),
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $params['qty'],
                    'attributes' => $attributes,
                    'associatedModel' => $product,
                ];

                if ($this->cartRepository->addItem($item, $this->getSessionKey($request))) {
                    return $this->responseOk(true, 200, 'success');
                }
            } catch (OutOfStockException $e) {
                return $this->responseError($e->getMessage(), 400);
            }
            return $this->responseError('Add item failed', 422);
        }
    }

    private function getSessionKey($request)
    {
        return md5($request->user()->id);
    }
}
