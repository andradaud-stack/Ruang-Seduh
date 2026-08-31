<?php

namespace Tests\Feature;

use App\Modules\Tables\Models\Tables;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTableQrTest extends TestCase
{
    use RefreshDatabase;

    public function test_table_token_is_generated_automatically(): void
    {
        $table = Tables::create(['table_number' => '01']);

        $this->assertNotEmpty($table->qr_token);
        $this->assertSame(36, strlen($table->qr_token));
    }

    public function test_scanning_table_qr_stores_table_in_customer_session(): void
    {
        $table = Tables::create(['table_number' => '01']);

        $response = $this->get(route('customer.table.scan', $table->qr_token));

        $response->assertRedirect(route('customer.home'));
        $this->assertSame($table->id, session('customer_table_id'));
    }
}