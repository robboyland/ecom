<?php

use App\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PasswordResetTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->mailtrap = new Client([
            'base_uri' => getenv('MAILTRAP_API_BASE_URI'),
            'headers' => [
                'Api-Token' => getenv('MAILTRAP_API_TOKEN')
            ]
        ]);

        $this->mailtrap_inbox = getenv('MAILTRAP_API_INBOX');
    }


    public function tearDown()
    {
        parent::tearDown();

        $this->cleanMessages();
    }


    private function getMessages()
    {
        $response = $this->mailtrap->request('GET', "inboxes/$this->mailtrap_inbox/messages");

        return json_decode((string) $response->getBody());
    }


    private function getLastMessage()
    {
        $messages = $this->getMessages();

        if (empty($messages))
        {
            $this->fail('Api Mailtrap: No messages found.');
        }

        return $messages[0];
    }


    public function assertEmailIsSent($description = '')
    {
        $this->assertNotEmpty($this->getMessages(), $description);
    }


    private function cleanMessages()
    {
        $response = $this->mailtrap->request('PATCH', "inboxes/$this->mailtrap_inbox/clean");
    }


    /** @test */
    public function a_user_can_reset_their_password()
    {
        $user = factory(User::class)->create();

        $this->visit('/password/email')
             ->type($user->email, 'email')
             ->press('Send Password Reset Link')
             ->seeInDatabase('password_resets', ['email' => $user->email]);

        $resetRecord = \DB::table('password_resets')->where('email', $user->email)->first() ;

        $message =  $this->getLastMessage();

        $this->assertEquals('Your Password Reset Link', $message->subject);
        $this->assertEquals($user->email, $message->to_email);
        $this->assertContains($resetRecord->token, $message->html_body);

        $this->visit('password/reset/' . $resetRecord->token)
             ->type($user->email, 'email')
             ->type('password', 'password')
             ->type('password', 'password_confirmation')
             ->press('Reset Password')
             ->seePageIs('dashboard');
    }
}
