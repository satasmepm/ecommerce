<?php

namespace App\Http\Controllers\backend;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;

class adminPageController extends Controller
{
    public function firstpage(){

        return view('adminPanel.admin_login');
    }

    public function postlogin(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('adminPanel.admindashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("error")->withSuccess('Oppes! You have entered invalid credentials');
        
    }

    public function dashboard(Request $request){
        return view('adminPanel.admindashboard');
    }

    public function product(){
        return view('adminPanel.newproduct');
    }
    public function error(){
        return view('adminPanel.error');
    }
    public function test(){
        return view('adminPanel.test');
    }

    
  

    
   

}
