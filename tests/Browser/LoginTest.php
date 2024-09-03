<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use SebastianBergmann\Type\VoidType;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Payment Processing');
        });
    }

    public function testLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'test@test.com')
                ->type('password', '123456789')
                ->press('Login')
                ->assertPathIs('/home');
        });
    }
}
