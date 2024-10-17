<?php

namespace App\Http\Requests\Brands;

class Update extends Store
{
    protected function titleUniqueRule() {
        return parent::titleUniqueRule()->ignore($this->brand->id);
    }
}
