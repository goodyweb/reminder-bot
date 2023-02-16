<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 
class PostGuzzleController extends Controller
{
    public function index()
    {
        $response = Http::get('https://discord.com/api/webhooks/1075667978584072274/5hfOlVy820u29XlJgD5_18VFOVkMGL-qJRC572wmvHn7v5FEz2TqVucdBHRyB6RUjB16');
   
        $jsonData = $response->json();
         
        dd($jsonData);
    }
 
    public function store()
    {
        $response = Http::post('https://discord.com/api/webhooks/1075667978584072274/5hfOlVy820u29XlJgD5_18VFOVkMGL-qJRC572wmvHn7v5FEz2TqVucdBHRyB6RUjB16', [
                    'title' => 'This is test from tutsmake.com',
                    'body' => 'This is test from tutsmake.com as body',
                ]);
   
        dd($response->successful());
    }
}