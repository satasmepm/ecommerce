<?php

namespace App\Http\Controllers\backend;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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

    
    public function addcategory(){
        return view('adminPanel.category');
    }

    
    public function postcategory(Request $request)
    {
        $request->validate([
            'categoryname'=>'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $category=new Category();
        $category->categoryname=$request['categoryname'];
        $category->description = $request['description'];
        $category->image = $imageName;
        $category->status = 1;
        $result =	$category->save(); 	

        if($result){
            return response()->json(['code'=>'true','msg'=>'Category created']);
        }
        else{
            return response()->json(['code'=>'false','msg'=>'Soemthing went wrong']);
        }
   
    }

    public function getData(){
        $data =  DB::table('category')->get();
      
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('status', function($data){

            // return $data->status;
            if($data->status===1){
            //   $status = "<span class='badge badge-pill badge-success mb-1'>Active</span>";     
             $status = '<span class="text-success">Active</span>';     
            }else{
            //   $status = "<span class='badge badge-pill badge-danger mb-1'>Inactive</span>";   
            $status = '<span class="text-warning">Deactive</span>';    
            }
            return $status; 
          })
        ->rawColumns(['status'])
        ->make(true);
        
    }

}
