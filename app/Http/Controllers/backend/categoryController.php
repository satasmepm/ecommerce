<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    
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

    public function addcategory(){
        return view('adminPanel.category');
    }

    public function getData(Request $request){
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
            $status = '<span class="text-warning">InActive</span>';    
            }
            return $status; 
          })
        ->addColumn('action',function($data){

            $btn = '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="edit"><i class="fas fa-edit text-secondary"></i></a>';
            $btn .= '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="update"><i class="fas fa-arrow-circle-up text-secondary"></i></a>';
            $btn .= '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="delete"> <i class="fas fa-trash-alt text-secondary"></i></a>';
            return $btn;
    
          
            
    })
    
    
        ->rawColumns(['status','action'])
        ->make(true);
    }
    
    public function deletecategory($id){

        $category = category::find($id);
        $category->status = 0;
        $result =  $category->save();  

        if($result){
            return response()->json(['code'=>'true','msg'=>'Category deleted']);
        }
        else{
            return response()->json(['code'=>'false','msg'=>'Soemthing went wrong']);
        }
    }


}
