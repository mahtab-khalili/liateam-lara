<?php

namespace Tests\Feature;

use Tests\TestCase;
use Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationTest extends TestCase
{
   
    /**
     * @test 
     * Test registration
     */
    public function testRegister(){
        //User's data
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'Test',
            'password' => 'secret1234',
        ];
        //Send post request
        $response = $this->json('POST',route('api.register'),$data);
        //Assert it was successful
        $response->assertStatus(200);
        //Assert we received a token
        // dd($response->json()['resource']);
        $this->assertArrayHasKey('access_token',$response->json()['resource']);
        //Delete data
        User::where('email','test@gmail.com')->delete();
    }

       /**
     * @test 
     * Test registration
     */
    public function testRegisterFaileWithDuplicateEmail(){
        //User's data
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'Test',
            'password' => 'secret1234',
        ];
        //Send post request
        $this->json('POST',route('api.register'),$data);
        $response = $this->json('POST',route('api.register'),$data);
        //Assert it was successful
        $response->assertStatus(422);
        //Delete data
        User::where('email','test@gmail.com')->delete();
    }

    /**
     * @test
     * Test login
     */
    public function testLogin()
    {
        User::factory()->create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => Hash::make('secret1234')
        ]);
        
        //attempt login
        $response = $this->json('POST',route('api.login'),[
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(200);
        $this->assertArrayHasKey('access_token',$response->json()['resource']);
        //Delete the user
        User::where('email','test@gmail.com')->delete();
    }

    /**
     * @test
     * Test login
     */
    public function testLoginHasErrorWithInvalidInfo()
    {
        User::factory()->create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => Hash::make('secret1234')
        ]);
        
        //attempt login
        $response = $this->json('POST',route('api.login'),[
            'email' => 'test@gmail.com',
            'password' => 'secree1234',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(401);

        //Delete the user
        User::where('email','test@gmail.com')->delete();
    }

}