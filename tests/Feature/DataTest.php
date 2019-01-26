<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Session;


class DataTest extends TestCase
{

    public function testIndexAction()
    {
        $response = $this->get('/');
        $response->assertStatus(200)
            ->assertViewHas('datas');
    }

    public function testStoreAction()
    {
        $this->markTestSkipped(
            "can't call api because of a bug in there causing our lunch to disappear"
        );
        Session::start();
        $random = str_random(5);
        $response = $this->call('POST', 'data', array(
            '_token' => csrf_token(),
            'name' => $random,
            'email' => 'test@gmail.com',
            'birth_date' => '01/10/2019',
            'phone_number' => '0819198191',
            'gender' => 'male',
            'address' => 'surabaya'
        ));
        // dd($response);
        $response->assertStatus(302);
        $response->assertRedirect('data');
        $response->assertSessionHas('message', 'Terima kasih telas mengisi form');
    }

    public function testShowAction(){
        Session::start();
        $dir    = base_path().'/storage/app/public/';
        $files = scandir($dir, 1);
        $dataall = array();
        for($i=0;$i<sizeof($files);$i++){
            if(strpos($files[$i],'.txt')==true){
                array_push($dataall,$files[$i]);
            }
        }
        // dd($dataall[0]);
        if(sizeof($dataall)>0){
            $response = $this->call('GET', 'data/'.$dataall[0]);
            $response->assertStatus(200)
            ->assertViewHas('data');
        }else{
            $this->assertTrue(true);
        }
       
    }

    public function testUpdateAction(){
        $dir    = base_path().'/storage/app/public/';
        $files = scandir($dir, 1);
        $dataall = array();
        for($i=0;$i<sizeof($files);$i++){
            if(strpos($files[$i],'.txt')==true){
                array_push($dataall,$files[$i]);
            }
        }
        if(sizeof($dataall)>0){
            $response = $this->call('PUT', 'data/'.$dataall[0], array(
                '_token' => csrf_token(),
                'email' => 'ada@gmail.com',
                'birth_date' => '01/10/2019',
                'phone_number' => '0819198191',
                'gender' => 'male',
                'address' => 'cobaupdate'
            ));
            $response->assertStatus(302);
            $response->assertRedirect('data');
            $response->assertSessionHas('message', 'Data berhasil diupdate');
        }else{
            $this->assertTrue(true);
        }
    }

    public function testDeleteAction(){
        // $this->markTestSkipped(
        //     "can't call api because of a bug in there causing our lunch to disappear"
        // );
        $dir    = base_path().'/storage/app/public/';
        $files = scandir($dir, 1);
        $dataall = array();
        for($i=0;$i<sizeof($files);$i++){
            if(strpos($files[$i],'.txt')==true){
                array_push($dataall,$files[$i]);
            }
        }
        if(sizeof($dataall)>0){
            $response = $this->call('DELETE', 'data/'.$dataall[0]);
            $response->assertStatus(302);
            $response->assertRedirect('data');
            $response->assertSessionHas('message', 'Data berhasil didelete');
        }else{
            $this->assertTrue(true);
        }
    }
}
