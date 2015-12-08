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

    /** @test */
    public function an_authenticated_user_should_be_redirected_from_login_to_the_home_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('auth/login')
             ->seePageIs('/');
    }

    /** @test */
    public function admin_is_redirected_to_cms_page_on_login()
    {
        $user = factory(User::class)->create(['admin' => '1']);

        $this->visit('auth/login')
             ->type($user->email,'email')
             ->type('password','password')
             ->press('Login')
             ->seePageIs('/cms');
    }

    /** @test */
    public function regular_users_redirected_to_dashboard_on_login()
    {
        $user = factory(User::class)->create();

        $this->visit('auth/login')
             ->type($user->email,'email')
             ->type('password','password')
             ->press('Login')
             ->seePageIs('/dashboard');
    }

    /** @test */
    public function regular_users_cannot_view_cms_section()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/cms')
             ->seePageIs('/dashboard');
    }

    /** @test */
    public function admin_can_view_cms_section()
    {
        $user = factory(User::class)->create(['admin' => '1']);

        $this->actingAs($user)
             ->visit('/')
             ->click('cms')
             ->see('cms');
    }

    /** @test */
    public function regular_users_can_view_dashboard()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/')
             ->click('dashboard')
             ->see('dashboard');
    }

    /** @test */
    public function an_admin_can_view_a_list_of_all_users()
    {
        $user = factory(User::class)->create(['admin' => 1]);
        $userTwo = factory(User::class)->create();
        $userThree = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('users')
             ->see($userTwo->name)
             ->see($userThree->name);
    }

        /** @test */
    public function an_admin_can_view_a_specific_users_details()
    {
        $user = factory(User::class)->create(['admin' => 1]);
        $userTwo = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('users/' . $userTwo->id)
             ->see($userTwo->name)
             ->seePageIs('users/' . $userTwo->id);
    }

}
