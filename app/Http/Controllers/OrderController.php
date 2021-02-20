<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Repositories\Front\Interfaces\CartRepositoryInterface;
use App\Repositories\Front\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $orderRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderRepositoryInterface $orderRepository, CartRepositoryInterface $cartRepository)
    {
        parent::__construct();

        $this->middleware('auth');
        $this->orderRepository = $orderRepository;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->getOrders(Auth::user(), 10);
        $this->data['orders'] = $orders;

        return $this->loadTheme('orders.index', $this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id order ID
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->getOrder(Auth::user(), $id);
        $this->data['order'] = $order;

        return $this->loadTheme('orders.show', $this->data);
    }


    /**
     * Show the checkout page
     *
     * @return void
     */
    public function checkout()
    {
        if ($this->cartRepository->isEmpty()) {
            return redirect('carts');
        }

        $this->cartRepository->removeConditionsByType('shipping');
        $this->cartRepository->updateTax();

        $items = $this->cartRepository->getContent();
        $this->data['items'] = $items;
        $this->data['totalWeight'] = $this->getTotalWeight() / 1000;

        $this->data['provinces'] = $this->getProvinces();
        $this->data['cities'] = isset(Auth::user()->province_id) ? $this->getCities(Auth::user()->province_id) : [];
        $this->data['user'] = Auth::user();

        return $this->loadTheme('orders.checkout', $this->data);
    }

    /**
     * Get cities by province ID
     *
     * @param Request $request province id
     *
     * @return json
     */
    public function cities(Request $request)
    {
        $cities = $this->getCities($request->query('province_id'));
        return response()->json(['cities' => $cities]);
    }

    /**
     * Calculate shipping cost
     *
     * @param Request $request shipping cost params
     *
     * @return array
     */
    public function shippingCost(Request $request)
    {
        $destination = $request->input('city_id');

        return $this->getShippingCost($destination, $this->getTotalWeight());
    }

    /**
     * Set shipping cost
     *
     * @param Request $request selected shipping cost
     *
     * @return string
     */
    public function setShipping(Request $request)
    {
        $this->cartRepository->removeConditionsByType('shipping');

        $shippingService = $request->get('shipping_service');
        $destination = $request->get('city_id');

        $shippingOptions = $this->getShippingCost($destination, $this->getTotalWeight());

        $selectedShipping = null;
        if ($shippingOptions['results']) {
            foreach ($shippingOptions['results'] as $shippingOption) {
                if (str_replace(' ', '', $shippingOption['service']) == $shippingService) {
                    $selectedShipping = $shippingOption;
                    break;
                }
            }
        }

        $status = null;
        $message = null;
        $data = [];
        if ($selectedShipping) {
            $status = 200;
            $message = 'Success set shipping cost';

            $this->cartRepositories->addShippingCostToCart($selectedShipping['service'], $selectedShipping['cost']);

            $data['total'] = number_format($this->cartRepository->getTotal());
        } else {
            $status = 400;
            $message = 'Failed to set shipping cost';
        }

        $response = [
            'status' => $status,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return $response;
    }

    /**
     * Get shipping cost option from api
     *
     * @param string $destination destination city
     * @param int    $weight      total weight
     *
     * @return array
     */
    private function getShippingCost($destination, $weight)
    {
        return $this->cartRepository->getShippingCost($destination, $weight);
    }

    /**
     * Get total of order items
     *
     * @return int
     */
    private function getTotalWeight()
    {
        return $this->cartRepository->getTotalWeight();
    }

    /**
     * Checkout process and saving order data
     *
     * @param OrderRequest $request order data
     *
     * @return void
     */
    public function doCheckout(OrderRequest $request)
    {
        $params = $request->except('_token');

        $order = $this->orderRepository->saveOrder($params);

        if ($order) {
            $this->cartRepository->clear();
            $this->sendEmailOrderReceived($order);

            Session::flash('success', 'Thank you. Your order has been received!');
            return redirect('orders/received/' . $order->id);
        }

        return redirect('orders/checkout');
    }

    /**
     * Send email order detail to current user
     *
     *
     * @return void
     */
    private function sendEmailOrderReceived($order)
    {
        \App\Jobs\SendMailOrderReceived::dispatch($order, Auth::user());
    }

    /**
     * Show the received page for success checkout
     *
     * @param int $orderId order id
     *
     * @return void
     */
    public function received($orderId)
    {
        $this->data['order'] = $this->orderRepository->getOrder(Auth::user(), $orderId);

        return $this->loadTheme('orders/received', $this->data);
    }
}
