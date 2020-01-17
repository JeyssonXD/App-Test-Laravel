<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\person;
use Illuminate\Support\Facades\Validator;
use App\viewModel\person\viewIndex;
use App\Helper\Sort;

class personController extends Controller
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
            $search->products = $request->get('products');

            //map current
            $currentFilter = new viewIndex();
            $currentFilter->name = $request->get('currentName');
            $currentFilter->products = $request->get('currentProducts');

            //map sort order
            $sortOrder = $request->get("sortOrder")??'name_ASC';

            //valid search
            if($search->isValid() && !$currentFilter->isValid()){
                $page=1;
            }else{
                $search = $currentFilter;
            }

            $currentFilter = $search;

            //validate
            $validatedData = Validator::make($model,[
                'name' => 'string|nullable',
                'products' => 'array|nullable'
            ]);

            //first expresion
            $query = person::with(['products']);

            //model state is valid --> search
            if($validatedData->messages()->count()==0){
                
                //name
                if(isset($search->name)){
                    $query = $query->where("name","=",$search->name);
                }

                //products
                if(isset($search->products)){
                    foreach($search->products as $idProductFiler){
                        $query = $query->whereHas("products",function($q) use($idProductFiler){
                            $q->where("idProduct","=",$idProductFiler);
                        });
                    }
                }
            }

            //order
            $currentOrder = $sortOrder;
            $nextOrder = Sort::nextSort(explode("_",$sortOrder)[0],explode("_",$sortOrder)[1]);

            switch($sortOrder){
                case "name_DESC":
                    $query =  $query->orderBy('name',"DESC");
                break;
                default:
                    $query = $query->orderBy('name',"ASC");
                break;
            }

            //paginate
            $listPaginated = $query->paginate(5);
    
            //resource page
            $products = product::All();
            
            if(!isset($search->products))$search->products = array();

            return view('person/index')
                    ->with("model",$search)
                    ->with("persons",$listPaginated)
                    ->with('products',$products)
                    ->with("currentFilter",$currentFilter)
                    ->with('nextOrder',$nextOrder)
                    ->with("currentOrder",$currentOrder)
                    ->withErrors($validatedData);
        }catch(\exception $e){
            dd($e);
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
        try{
            //resource
            $productsList = product::All();
            return view('person.create')
                    ->with('products',[])
                    ->with('productsList',$productsList);
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
            $model = $request->All();

            //validate
            $validatedData = Validator::make($model,[
                'name' => 'required|string',
                'products'=>'required|array'
            ]);
            
            //valid exist
            $personExist = person::where("name","=",$model['name'])->first();
            
            //custom error
            if(isset($personExist)){
                $validatedData->errors()->add("name","don't have two register equals");
            }

            //model state is valid
            if($validatedData->messages()->count()==0){
                //map to info
                $person = new person();
                $person->name = $model['name'];

                //save
                $person->save();

                $products = product::find($model['products']);
                //add
                $person->products()->attach($products);
                //$person->products()->attach($products,["count"=>$model['count']]); add field extra

                return view('share/messageResult',
                            [ 'Links' => array(
                                            "List of person"=>array("Text"=>"List of person","Link"=>Route('personIndex')),
                                            "Create"=>array("Text"=>"Create other person","Link"=>Route('personCreate'))
                                        ),
                                'Title' => "Success",
                                'Type' => 3,
                                'Message' => "this operation is executed correctly"
                            ]);
            }

            //resource
            if(!isset($request->products)){  $model["products"]= array(); }
            $products = product::All();
            
            return view('person.create',$model)
                    ->with('productsList',$products)
                    ->withErrors($validatedData);

        }catch(\exception $e){
            dd($e);
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
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
