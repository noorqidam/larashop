<?php

namespace App\Repositories\Admin\Interfaces;

interface AttributeRepositoryInterface
{
    /**
     * Get configurable attribute
     *
     * @return Collection
     */
    public function getConfigurableAttributes();
}
