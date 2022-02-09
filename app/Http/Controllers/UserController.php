<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request){

         $rules=[
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'mobile'=>'required|unique:users,mobile',
                'address' => 'required',
                'password' => 'required|same:password_confirmation',
                // 'password_confirmation' => 'required'

            ];
           $messages =[
                'name.required' => 'This  Name field is required.',
                'email.required' => 'This Email field is required.',
                'mobile.required' => 'This Mobile field is required.',
                'address.required' => 'This Address field is required.',
                'password.required' => 'This password field is required.',
                'password_confirmation' =>  'This comfirm password is required'
            ];

      
            $validator = Validator::make($request->all(),$rules,$messages);
             $error_array = array();
             $success_output="";
             $field_named= array();
              if($validator->fails())
             {
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $error_array[]=$messages;
                     $field_named[]= $field_name;
                }

             }
             else
             {
           
          $input = $request->all();
          $input['password'] = Hash::make($input['password']);
          $user = User::create($input);


              $success_output='<div class="alert alert-success col-md-12">'.'<button type="button" class="close closedk" data-dismiss="alert">'.'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button><p>User Add success.</p></div>';
                }
                $output= array(
                'error' => $error_array,
                'success' => $success_output,
                'field_name' => $field_named
                 );
               echo json_encode($output);
              
    }

    public function list(){
    	return Datatables::of(User::latest()->get())
         ->addColumn('action' ,function($data){
         $button = '<div class="btn-style-action">
                    <div class="row">
                    <button type="button" name="edit" id="" onclick="show_detail(`'.$data->id.'`)" class="edit btn btn-x"><i class="fa fa-eye"></i></button>
                   <button type="button" name="edit" id="" onclick="edit(`'.$data->id.'`)" class="edit btn btn-x"><i class="fas fa-edit"></i></button>
                   <button type="button" name="delete" id="" onclick="deleting(`'.$data->id.'`)" class="delete btn btn-x"><i class="fa fa-trash"></i></button>
                  </div>
                </div>';

        return $button;
    })
     ->rawColumns(['action'])
    ->make(true);
     }

public function edit(Request $request){

	return User::find($request->id);

}     
    
public function update(Request $request){



         $rules=[
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$request->id,
                'mobile'=>'required|unique:users,mobile,'.$request->id,
                'address' => 'required',
                // 'password' => 'required|same:password_confirmation',
                // 'password_confirmation' => 'required'

            ];
           $messages =[
                'name.required' => 'This  Name field is required.',
                'email.required' => 'This Email field is required.',
                'mobile.required' => 'This Mobile field is required.',
                'address.required' => 'This Address field is required.',
                // 'password.required' => 'This password field is required.',
                // 'password_confirmation' =>  'This comfirm password is required'
            ];

      
            $validator = Validator::make($request->all(),$rules,$messages);
             $error_array = array();
             $success_output="";
             $field_named= array();
              if($validator->fails())
             {
                foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                    $error_array[]=$messages;
                     $field_named[]= $field_name;
                }

             }
             else
             {
           
               $newdata = User::find($request->id);

               $input = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile'=> $request->mobile,
                'address' => $request->address,
                ];
               $newdata->update($input);
             
                $success_output='<div class="alert alert-success col-md-12">'.'<button type="button" class="close closedk" data-dismiss="alert">'.'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button><p>User Update success.</p></div>';
                }
                $output= array(
                'error' => $error_array,
                'success' => $success_output,
                'field_name' => $field_named
                 );
               echo json_encode($output);
              



 }


public function delete(Request $request){

	$very = User::find($request->id)->delete();

	if($very){

		 echo json_encode(['success' => '<div class="alert alert-danger col-md-12">'.'<button type="button" class="close closedk" data-dismiss="alert">'.'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button><p>User Delete Success.</p></div>']);
	}else{

      echo json_encode(['success' => '<div class="alert alert-danger col-md-12">'.'<button type="button" class="close closedk" data-dismiss="alert">'.'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button><p>Something wrong!.</p></div>']);

	}
}


}
