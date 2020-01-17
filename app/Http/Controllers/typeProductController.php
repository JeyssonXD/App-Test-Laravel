<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\typeProduct;
use Illuminate\Support\Facades\Validator;
use App\ViewModel\typeProduct\viewIndex;
use App\Helper\Sort;


class typeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try{
            $model = $request->all();
        
            //map search
            $search = new viewIndex();
            $search->name = $request->get('name');
    
            //map currentFilter
            $currentFilter = new viewIndex();
            $currentFilter->name = $request->get("currentName");
    
            //map sort order
            $sortOrder = $request->get("sortOrder")??'name_ASC';
    
            if($search->isValid() && !$currentFilter->isValid()){
                $page=1;
            }else{
                $search = $currentFilter;
            }
    
            //viewBag
            $currentFilter = $search;
    
            //validate
            $validatedData = Validator::make($model,[
                'name' => 'string|nullable'
            ]);
    
            //first expresion
            $query = typeProduct::where("id","!=",0);
    
            //model state is valid --> search
            if($validatedData->messages()->count()==0){
                
                //name
                if(isset($search->name)){
                    $query = $query->where("name","=",$search->name);
                }

            }
    
            //order
            $currentOrder = $sortOrder;
            $nextOrder = Sort::nextSort(explode("_",$sortOrder)[0],explode("_",$sortOrder)[1]);
    
            switch($sortOrder){
                case "name_ASC":
                    $query =  $query->orderBy('name',"DESC");
                break;
                default:
                    $query = $query->orderBy('name',"ASC");
                break;
            }
    
            //paginate
            $listPaginated = $query->paginate(5);
    
            return view('typeProduct/index')
                    ->with("model",$search)
                    ->with("typeProducts",$listPaginated)
                    ->with("currentFilter",$currentFilter)
                    ->with("currentOrder",$currentOrder)
                    ->with('nextOrder',$nextOrder)
                    ->withErrors($validatedData);
        }catch(\Exception $e){
            //function register log
            return view('share/messageResult',
            [ 
                'Title' => "Sorry, an error has occurred",
                'Type' => 0,
                'Message' => "this operation don't executed correctly, we working in solutions, please"
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("typeProduct.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            //get form
            $model = $request->all();

            //validate
            $validatedData = Validator::make($model,[
                'name' => 'required|string'
            ]);

            $typeProductExist = typeProduct::where("name","=",$model["name"])->first();
            if(isset($typeProductExist)){
                //add custom errors
                $validatedData->errors()->add('name', "don't have two register equals");
            }

            //model state is valid
            if($validatedData->messages()->count()==0){
                $typeProduct = new typeProduct();
                //mapping data
                $typeProduct->name = $model["name"];
                //save changes
                $typeProduct->save();

                return view('share/messageResult',
                            [ 'Links' => array(
                                            "List of type products"=>array("Text"=>"List of type product","Link"=>Route('typeProductIndex')),
                                            "Create"=>array("Text"=>"Create other type product","Link"=>Route('typeProductCreate'))
                                        ),
                            'Title' => "Success",
                            'Type' => 3,
                            'Message' => "this operation is executed correctly"
                            ]);
            }
            
            return view('typeProduct/create',$model)
                    ->withErrors($validatedData);

        }catch(\exception $e){
            //function register log
            return view('share/messageResult',
                        [ 
                        'Title' => "Sorry, an error has occurred",
                        'Type' => 0,
                        'Message' => "this operation don't executed correctly, we working in solutions, please"
                        ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        try{
            //search
            $typeProduct  = typeProduct::where("id","=",$id)->first();

            if(!isset($typeProduct)){
                return view('share/messageResult',
                        [ 
                            'Title' => "Resource not found",
                            'Type' => 1,
                            'Message' => "not found data with the params sending, if any error, please report with administrator"
                        ]);
            }

            return view('typeProduct.edit',$typeProduct);
        }catch(\exception $e){
            //function register log
            return view('share/messageResult',
                        [ 
                        'Title' => "Sorry, an error has occurred",
                        'Type' => 0,
                        'Message' => "this operation don't executed correctly, we working in solutions, please"
                        ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try{
            //map product as viewmodel
            $model = $request->all();

            //validate
            $validatedData = Validator::make($model,[
                'id'=>'numeric|required',
                'name' => 'string|required'
            ]);

            //custom validation
            $typeProductExist = typeProduct::where("name","=",$model['name'])
            ->where("id","!=",$model['id'])
            ->first();

            if(isset($typeProductExist)){
                //add custom errors
                $validatedData->errors()->add('name', "don't have two register equals");
            }

            if($validatedData->messages()->count()==0){


                
                //search
                $typeProduct = typeProduct::where("id","=",$model['id'])->first();

                if(!isset($typeProduct)){
                    return view('share/messageResult',
                            [ 
                                'Title' => "Resource not found",
                                'Type' => 1,
                                'Message' => "not found data with the params sending, if any error, please report with administrator"
                            ]);
                }

                //map update
                $typeProduct->name = $model['name'];
                //save
                $typeProduct->save();

                return view('share/messageResult',
                        [ 'Links' => array(
                                        "List of type of products"=>array("Text"=>"List of type product's","Link"=>Route('typeProductIndex')),
                                        "Create"=>array("Text"=>"Create to new product","Link"=>Route('typeProductCreate')),
                                        "View"=>array("Text"=>"view data actuality","Link"=>Route('typeProductEdit',['id'=>$typeProduct->id]))
                                    ),
                            'Title' => "Success",
                            'Type' => 3,
                            'Message' => "this operation is executed correctly"
                        ]);
            }
            
            //resource
            $TypeProducts = TypeProduct::All();
            
            return view('typeProduct.edit',$model)
                    ->withErrors($validatedData);
        }catch(\exception $e){
            //function register log
            return view('share/messageResult',
                        [ 
                        'Title' => "Sorry, an error has occurred",
                        'Type' => 0,
                        'Message' => "this operation don't executed correctly, we working in solutions, please"
                        ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try{

            $id = $request->get('id');
            if(!isset($id)){
                return view('share/messageResult',
                [ 
                    'Title' => "Resource not found",
                    'Type' => 1,
                    'Message' => "not found data with the params sending, if any error, please report with administrator"
                ]);
            }

            $typeProduct = typeProduct::where('id','=',$id)->first();

            if(!isset($typeProduct)){
                return view('share/messageResult',
                [ 
                    'Title' => "Resource not found",
                    'Type' => 1,
                    'Message' => "not found data with the params sending, if any error, please report with administrator"
                ]);
            }

            //delete
            $deleteRows = typeProduct::where("id","=",$typeProduct->id)->delete();

            return view('share/messageResult',
                    [ 'Links' => array(
                                    "List of type products"=>array("Text"=>"List of type product","Link"=>Route('typeProductIndex'))
                                ),
                    'Title' => "Success",
                    'Type' => 3,
                    'Message' => "this operation is executed correctly"
                    ]);
        }catch(\Exception $e){
            //function register log
            return view('share/messageResult',
                        [ 
                        'Title' => "Sorry, an error has occurred",
                        'Type' => 0,
                        'Message' => "this operation don't executed correctly, we working in solutions, please"
                        ]);
        }
    }
}
