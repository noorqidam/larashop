<?php

namespace App\Repositories\Admin;

use App\Repositories\Admin\Interfaces\AttributeRepositoryInterface;
use App\Models\Attribute;

class AttributeRepository implements AttributeRepositoryInterface
{
    /**
     * Get configurable attributes for products
     *
     * @return array
     */
    public function getConfigurableAttributes()
    {
        return Attribute::where('is_configurable', true)->get();
    }
}
