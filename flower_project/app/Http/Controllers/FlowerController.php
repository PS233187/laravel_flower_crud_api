<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     * *  @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $request->user()->currentAccessToken()->delete(); // delete token

    Log::info(
        'flowers index',
        [
            'ip' => $request->ip(),
            'data' => $request->all()
        ]
    );

    if ($request->has('flower_name')) {
        $data = Flower::where('flower_name', 'like', '%' . $request->flower_name . '%')->get();
    } elseif ($request->has('sort')) {
        $data = Flower::orderBy($request->sort)->get();
    } else {
        $data = Flower::all();
    }

    $content = [
        'success' => true,
        'data' => $data,
        'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
        'token_type' => 'Bearer',
    ];
    return response()->json($content, 200);
}


    /**
     * Show the form for creating a new resource.
     *
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {

       $request->user()->currentAccessToken()->delete(); 
       
       Log::info(
        'flowers store',
        [
            'ip' => $request->ip(),
            'data' => $request->all()
        ]
    );
       
       $validator = Validator::make($request->all(), 
       [
        'flower_type' => 'required',
        'flower_name' => 'required',
        'store_id' => 'required'
       ]);

            if ($validator->fails()) {
            Log::error("flowers toevoegen Fout");
            $content = [
                'success' => false,
                'data'    => $request->all(),
                'foutmelding' => 'Data niet correct',
                'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
                'token_type' => 'Bearer',
            ];
            return response()->json($content, 400);
        } else {
            $content = [
                'success' => true,
                'data'    => Flower::create($request
                    ->only(['flower_name', 'store_id', 'flower_type'])),
                'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
                'token_type' => 'Bearer',
            ];
            return response()->json($content, 201);
        }
    }


  /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Flower $flower)
    {
        $request->user()->currentAccessToken()->delete();    // Verwijder de actuele token

        Log::info(
            'flowers show',
            [
                'ip' => $request->ip(),
                'data' => $request->all()
            ]
        );

        $content = [
            'success' => true,
            'data'    => $flower,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 200);

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flower $flower)
    {
        $request->user()->currentAccessToken()->delete();    // Verwijder de actuele token

        Log::info(
            'flower update',
            ['ip' => $request->ip(), 'oud' => $flower, 'nieuw' => $request->all()]
        );

        $validator = Validator::make($request->all(), [
        'flower_type' => 'required',
        'flower_name' => 'required'
        
        ]);
        if ($validator->fails()) {
            Log::error("flowers wijzigen Fout");
            $content = [
                'success' => false,
                'data'    => $request->all(),
                'foutmelding' => 'Gewijzigde data niet correct',
                'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
                'token_type' => 'Bearer',    
            ];
            return response()->json($content, 400);
        } else {
            $content = [
                'success' => $flower->update($request->all()),
                'data'    => $request->only(['flower_name', 'store_id', 'flower_type']),
                'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
                'token_type' => 'Bearer',    
            ];
            return response()->json($content, 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Flower $flower)
    {
        $request->user()->currentAccessToken()->delete();    // Verwijder de actuele token

        Log::info(
            'flower destroy',
            ['ip' => $request->ip(), 'oud' => $flower]
        );
        $flower->delete();

        $content = [
            'success' => true,
            'data'    => $flower,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 202);

    }

    public function indexStore(Request $request, $id)
    {
        $request->user()->currentAccessToken()->delete();    // Verwijder de actuele token

        Log::info(
            'flowers indexStore',
            [
                'ip' => $request->ip(),
                'data' => $request->all(),
                'id' => $id
            ]
        );
        if ($request->has('sort')) {
            $data =  Flower::where('store_id', $id)->orderBy($request->sort)->get();
        } else {
            $data = Flower::where('store_id', $id)->get();
        }

        $content = [
            'success' => true,
            'data'    => $data,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 200);
    }
    public function destroyStore(\Illuminate\Http\Request $request, $id)
    {
        $request->user()->currentAccessToken()->delete();    // Verwijder de actuele token
    
        Log::info(
            'flowers destroyStore',
            [
                'ip' => $request->ip(),
                'data' => $request->all(),
                'store id' => $id
            ]
        );
        Flower::where('store_id', $id)->delete();
    
        $content = [
            'success' => true,
            'data'    => $id,
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
        return response()->json($content, 202);
    }
}
