<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

use Hash;
use Auth;

use App\role;
use App\user;


class authController extends Controller
{
    /**
     * Show the form for login.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::check()){
            return redirect()->intended("/");
        }
        return view("auth/login");
    }

        /**
     * logged petition.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginIn(Request $request){
        try{
            //map data
            $model=$request->all();
            
            //validation
            $validateData = Validator::make($model,[
                'email'=>'required|email',
                'password'=>'required',
                'remember'=>'string'
            ]);

            //model valid
            if($validateData->messages()->count()==0){
                $remember=0;
                if(isset($model['remember']))$remember=1;
                
                if (Auth::attempt(['email' => $model['email'], 'password' => $model['password']])) {
                    return redirect()->intended('/');
                }else{
                    $validateData->errors()->add("password","Credentials invalid");
                }
            }
            return view("auth/login",$model)
                        ->withErrors($validateData);
        }catch(\exception $e){
            dd($e);
            return view('share/messageResult',
                        [ 
                            'Title' => "Sorry, an error has occurred",
                            'Type' => 0,
                            'Message' => "this operation don't executed correctly, we working in solutions, please"
                        ]);
        }
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect()->intended("/auth/login");
        }else{
            return redirect()->intended("/");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        //
        try{

            //resource
            $rolesList = role::all();
        
            return view("auth/register")
                        ->with("roles",[])
                        ->with("rolesList",$rolesList);

        }catch(\exception $e){
            
            return view('share/messageResult',
                    [ 
                        'Title' => "Sorry, an error has occurred",
                        'Type' => 0,
                        'Message' => "this operation don't executed correctly, we working in solutions, please"
                    ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            //map data
            $model = $request->all();

            //validate
            $validatedData = Validator::make($model,[
                'name' => 'required|string|unique:users',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/| confirmed',
                'roles'=>'required|array'
            ]);
            
            //valid exist
            $userExist = user::where("name","=",$model['name'])->first();
            
            //custom error
            if(isset($userExist)){
                $validatedData->errors()->add("name","don't have two register equals");
            }

            //model state is valid
            if($validatedData->messages()->count()==0){
                //map to info
                $user = new user();
                $user->name = $model['name'];
                $user->email = $model['email'];
                $user->password=Hash::make($model['password']);
                $user->save();
                $roles = role::find($model['roles']);
                $user->roles()->attach($roles);
                
                return view('share/messageResult',
                            [ 'Links' => array(
                                            "Create"=>array("Text"=>"Create other user","Link"=>Route('userRegister'))
                                        ),
                            'Title' => "Success",
                            'Type' => 3,
                            'Message' => "this operation is executed correctly"
                            ]);
            }

            //resource
            if(!isset($request->roles)){  $model["roles"]= array(); }
            $rolesList = role::all();

            return view("auth/register",$model)
                        ->with("rolesList",$rolesList)
                        ->withErrors($validatedData);

        }catch(\exception $e){
            return view('share/messageResult',
                        [ 
                            'Title' => "Sorry, an error has occurred",
                            'Type' => 0,
                            'Message' => "this operation don't executed correctly, we working in solutions, please"
                        ]);
        }
    }
}
