<?php

namespace App\Http\Controllers;

use App\product;
use App\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ViewModel\Product\viewIndex;
use App\Helper\Sort;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $model = $request->all();
        
            //map search
            $search = new viewIndex();
            $search->name = $request->get('name');
            $search->price = $request->get('price');
            $search->idTypeProduct = $request->get('idTypeProduct');
    
            //map currentFilter
            $currentFilter = new viewIndex();
            $currentFilter->name = $request->get("currentName");
            $currentFilter->price = $request->get("currentPrice");
            $currentFilter->idTypeProduct = $request->get("currentIdTypeProyect");
    
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
                'name' => 'string|nullable',
                'price' => 'numeric|nullable',
                'idTypeProduct' => 'nullable'
            ]);
    
            //first expresion
            $query = product::with(['typeProduct']);
    
            //model state is valid --> search
            if($validatedData->messages()->count()==0){
                
                //name
                if(isset($search->name)){
                    $query = $query->where("name","=",$search->name);
                }
    
                //price
                if(isset($search->price)){
                    $query = $query->where("price","=",$search->price);
                }
    
                //typeProduct
                if(isset($search->idTypeProduct) && $search->idTypeProduct>0){
                    $query = $query->whereHas("typeProduct",function($q) use($search){
                        $q->where("id","=",$search->idTypeProduct);
                    });
                }
            }
    
            //order
            $sortOrder = Sort::nextSort(explode("_",$sortOrder)[0],explode("_",$sortOrder)[1]);
            $currentOrder = $sortOrder;
    
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
    
            //resource page
            $typeProducts = TypeProduct::All();
    
            return view('product/index')
                    ->with("model",$search)
                    ->with("products",$listPaginated)
                    ->with("typeProducts",$typeProducts)
                    ->with("currentFilter",$currentFilter)
                    ->with("currentOrder",$currentOrder)
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
        try{
            //resource
            $TypeProducts = TypeProduct::All();
            return view('product.create')->with('TypeProducts',$TypeProducts);

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
                'Name' => 'required|string',
                'Price' => 'required|numeric|max:999|min:1',
                'idTypeProduct' => 'required',
            ]);

            //custom validation
            $productExist = product::where("name","=",$model["Name"])->first();
            if(isset($productExist)){
                //add custom errors
                $validatedData->errors()->add('Name', "don't have two register equals");
            }

            //model state is valid
            if($validatedData->messages()->count()==0){
                $product = new product;
                //mapping data
                $product->name = $model["Name"];
                $product->price = $model["Price"];
                $product->idTypeProduct = $model["idTypeProduct"];
                //save changes
                $product->save();

                return view('share/messageResult',
                            [ 'Links' => array(
                                            "List of products"=>array("Text"=>"List of product","Link"=>Route('productIndex')),
                                            "Create"=>array("Text"=>"Create other product","Link"=>Route('productCreate'))
                                        ),
                            'Title' => "Success",
                            'Type' => 3,
                            'Message' => "this operation is executed correctly"
                            ]);
            }

            //resource page
            $TypeProducts = TypeProduct::All();

            return view('product/create',$model)
                    ->with('TypeProducts',$TypeProducts)
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request,$id)
    {
        try{
  
            //search
            $product  = product::where("id","=",$id)->first();

            if(!isset($product)){
                return view('share/messageResult',
                [ 
                    'Title' => "Resource not found",
                    'Type' => 1,
                    'Message' => "not found data with the params sending, if any error, please report with administrator"
                ]);
            }

            //resource
            $TypeProducts = TypeProduct::All();

            return view('product.edit',$product)
                    ->with('TypeProducts',$TypeProducts);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(request $request)
    {
        try{
            //map product as viewmodel
            $model = $request->all();

            //validate
            $validatedData = Validator::make($model,[
                'id'=>'numeric|required',
                'name' => 'string|required',
                'price' => 'numeric|required|max:999|min:1',
                'idTypeProduct' => 'numeric|required',
            ]);

            if($validatedData->messages()->count()==0){

                //custom validation
                $productExist = product::where("name","=",$model['name'])
                                        ->where("id","!=",$model['id'])
                                        ->first();

                if(isset($productExist)){
                    //add custom errors
                    $validatedData->errors()->add('Name', "don't have two register equals");
                }
                //search
                $product = product::where("id","=",$model['id'])->first();

                if(!isset($product)){
                    return view('share/messageResult',
                    [ 
                        'Title' => "Resource not found",
                        'Type' => 1,
                        'Message' => "not found data with the params sending, if any error, please report with administrator"
                    ]);
                }

                //map update
                $product->name = $model['name'];
                $product->price = $model['price'];
                $product->idTypeProduct = $model['idTypeProduct'];
                //save
                $product->save();

                return view('share/messageResult',
                        [ 'Links' => array(
                                        "List of products"=>array("Text"=>"List of product","Link"=>Route('productIndex')),
                                        "Create"=>array("Text"=>"Create to new product","Link"=>Route('productCreate')),
                                        "View"=>array("Text"=>"view data actuality","Link"=>Route('productEdit',['id'=>$product->id]))
                                    ),
                        'Title' => "Success",
                        'Type' => 3,
                        'Message' => "this operation is executed correctly"
                        ]);
            }

            //resource
            $TypeProducts = TypeProduct::All();
            
            return view('product.edit',$model)
                    ->with('TypeProducts',$TypeProducts)
                    ->withErrors($validatedData);

        }catch(\Exception $e){
            //function register log
            return view('share/messageResult',
            [ 
                'Title' => "Sorry, an error has occurred",
                'Type' => 0,
                'Message' => "this operation don't executed correctly, we working in solutions, please.\n".$e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        try{
            //
            $id = $request->get('id');
            if(!isset($id)){
                return view('share/messageResult',
                [ 
                    'Title' => "Resource not found",
                    'Type' => 1,
                    'Message' => "not found data with the params sending, if any error, please report with administrator"
                ]);
            }

            $product = product::where('id','=',$id)->first();

            if(!isset($product)){
                return view('share/messageResult',
                [ 
                    'Title' => "Resource not found",
                    'Type' => 1,
                    'Message' => "not found data with the params sending, if any error, please report with administrator"
                ]);
            }

            //delete
            $deleteRows = product::where("id","=",$product->id)->delete();

            return view('share/messageResult',
                    [ 'Links' => array(
                                    "List of products"=>array("Text"=>"List of product","Link"=>Route('productIndex'))
                                ),
                    'Title' => "Success",
                    'Type' => 3,
                    'Message' => "this operation is executed correctly"
                    ]);

        }catch(\Exception $e){
            dd($e);
            //function register log
            return view('share/messageResult',
                [ 
                    'Title' => "Sorry, an error has occurred",
                    'Type' => 0,
                    'Message' => "this operation don't executed correctly, we working in solutions, please.\n".$e->getMessage()
                ]);
        }
    }
}
