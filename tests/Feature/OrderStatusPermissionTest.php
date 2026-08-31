<?php

namespace Tests\Feature;

use App\Helpers\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderStatusPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_status_route_uses_update_permission(): void
    {
        session(['privileges' => [
            'orders' => [
                'read' => true,
                'update' => true,
                'delete' => false,
                'create' => false,
                'show' => false,
            ],
        ]]);

        $this->assertTrue(Permission::can('orders.update-status'));
    }
}
