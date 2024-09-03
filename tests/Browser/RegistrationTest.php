<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use SebastianBergmann\Type\VoidType;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */

    public function testRegistration(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'dusk test')
                ->type('email', 'dusk@test.com')
                ->type('password', '123456789')
                ->type('password_confirmation', '123456789')
                ->press('Register')
                ->assertPathIs('/home');
        });
    }
}
