<?php

namespace Tests\Feature;

use App\Modules\Order_items\Models\Order_items;
use App\Modules\Orders\Models\Orders;
use Tests\TestCase;

class OrderMassAssignmentTest extends TestCase
{
    public function test_order_and_order_items_allow_checkout_fields_for_mass_assignment()
    {
        $this->assertTrue((new Orders())->isFillable('total'));
        $this->assertTrue((new Orders())->isFillable('pengguna_id'));
        $this->assertTrue((new Orders())->isFillable('table_id'));
        $this->assertTrue((new Order_items())->isFillable('menu_id'));
        $this->assertTrue((new Order_items())->isFillable('subtotal'));
    }
}
