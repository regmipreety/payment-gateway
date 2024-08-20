<?php

namespace Tests\Feature;

use App\Services\PaypalService;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;

class PaymentControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        // Set up any needed mocks, etc.
        $this->mock(PaypalService::class, function ($mock) {
            $mock->shouldReceive('handlePayment')
                ->andReturn(response('Payment Processed', 200));
            $mock->shouldReceive('handleApproval')
                ->andReturn(redirect()->route('home')->withSuccess('Payment Approved'));
        });
    }

    /** @test */
    public function it_requires_authentication_to_access_payment_routes()
    {
        $response = $this->post(route('pay'));
        $response->assertRedirect(route('login'));
    
        $response = $this->get(route('approval'));
        $response->assertRedirect(route('login'));
    
        $response = $this->get(route('cancelled'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function it_validates_payment_request()
    {
        $this->actingAsUser();

        $response = $this->post(route('pay'), [
            // Empty request data
        ]);

        $response->assertSessionHasErrors(['value', 'currency', 'payment_platform']);
    }

    /** @test */
    public function it_processes_payment_with_valid_data()
    {
        $this->actingAsUser();

        $response = $this->post(route('pay'), [
            'value' => 10,
            'currency' => 'usd',
            'payment_platform' => 'PayPal',
        ]);
        $response->assertStatus(200);
        $response->assertSee('Payment Processed');
    }

    /** @test */
    public function it_handles_payment_approval()
    {
        $this->actingAsUser();

        $response = $this->get(route('approval'));

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');
    }

    private function actingAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
