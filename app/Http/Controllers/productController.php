<?php

namespace App\Http\Controllers;

use App\product;
use App\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ViewModel\Product\viewIndex;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,viewIndex $search)
    {
        $model = $request->all();
        //map currentFilter
        $currentFilter = new viewIndex();
        if($request->has("currentName")) $currentFilter->name = $model["currentName"];
        if($request->has("currentPrice")) $currentFilter->name = $model["currentPrice"];
        if($request->has("currentIdTypeProduct")) $currentFilter->name = $model["currentTypeProduct"];
        
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
            'idTypeProduct' => 'numeric|nullable'
        ]);

        //first expresion
        $query = product::with(['typeProduct']);

        //model state is valid
        if($validatedData->messages()->count()==0){

            //name
            if(isset($search->name)){
                $query = $query->where("name","=",$search->name);
            }

            //price
            if(isset($search->price)){
                $query = $query->where("price","=",$search->price);
            }

            if(isset($search->idTypeProyect)){
                //$query = $query->where("","","")
            }

        }

        //paginate
        $products = $query->paginate(3);

        //resource page
        $typeProducts = TypeProduct::All();

        return view('product/index')
                ->with("products",$products)
                ->with("typeProducts",$typeProducts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $TypeProducts = TypeProduct::All();

        return view('product.create')->with('TypeProducts',$TypeProducts);
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
                'Name' => 'required',
                'Price' => 'required|max:999|min:1',
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
                                            "List of products"=>array("Text"=>"Product","Link"=>Route('productIndex'))
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
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
