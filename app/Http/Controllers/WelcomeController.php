<?php
namespace App\Http\Controllers;
use Carbon\Carbon;  
class WelcomeController extends Controller
{ 
    public function welcome()
    {
		
		return View('welcome');
    }
}
