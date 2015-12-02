<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function guest_users_cant_view_the_dashboard()
    {
        $this->visit('dashboard')
             ->seePageIs('auth/login');
    }

    /** @test */
    public function a_user_can_register()
    {
        $this->visit('auth/register')
             ->type('Blinky', 'name')
             ->type('blinky@example.com', 'email')
             ->type('password', 'password')
             ->type('password', 'password_confirmation')
             ->press('Register')
             ->seePageIs('dashboard')
             ->seeInDatabase('users', ['email' => 'blinky@example.com']);
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = factory(User::class)->create();

        $this->visit('auth/login')
             ->type($user->email, 'email')
             ->type('password', 'password')
             ->check('remember')
             ->press('Login')
             ->seePageIs('dashboard');
    }
}
