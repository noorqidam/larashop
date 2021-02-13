<?php

namespace App\Repositories\Front\Interfaces;

interface CatalogueRepositoryInterface
{
    public function paginate($perPage, $request);

    public function findBySlug($slug);

    public function findBySKU($sku);

    public function findProductById($productID);

    public function getAttributeOptions($product, $attributeName);

    public function getParentCategories();

    public function getAttributeFilters($attributeCode);

    public function getMinPrice();

    public function getMaxPrice();

    public function getProductbyAtrributes($product, $params);

    public function checkProductInventory($product, $qtyRequested);
}
