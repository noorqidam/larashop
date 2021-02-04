<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminMenu'] = 'catalog';
        $this->data['currentAdminSubMenu'] = 'product';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['products'] = Product::orderBy('name', 'asc')->paginate(10);
        return view('admin.products.index', $this->data);
        // return view('admin.dashboard.index');
    }
}
