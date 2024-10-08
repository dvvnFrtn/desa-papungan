<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    public function getData(){
    $client = new Client();

     $response = $client->request("GET", env("API_BASE_URL", "http://localhost:8001") . "/api/data-desa/3");
     $struktur = json_decode($response->getBody());

     $response = $client->request("GET", env("API_BASE_URL", "http://localhost:8001") . "/api/perangkat-desa");
     $perangkatDesas = json_decode($response->getBody());

     $response2 = $client->request("GET", env("API_BASE_URL", "http://localhost:8001") . "/api/lembaga");    
     $lembagas = json_decode($response2->getBody());

     return view("pemerintahan",["struktur"=>$struktur, "perangkatDesas"=>$perangkatDesas,"lembagas"=>$lembagas]);
    //dd($lembagas);
    }
}
