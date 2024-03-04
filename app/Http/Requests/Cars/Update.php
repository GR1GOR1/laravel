<?php

namespace App\Http\Requests\Cars;

class Update extends Store
{
    protected function vinUniqueRule() {
        return parent::vinUniqueRule()->ignore($this->car->id);
    }
}
