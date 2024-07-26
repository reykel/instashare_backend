<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Authorized;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorizedResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Authorized\AuthorizedStoreRequest;
use App\Http\Requests\Authorized\AuthorizedUpdateRequest;

class AuthorizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'authorizeds' => Authorized::all(),
            'message' => 'Retrieved Successfully'
        ], 200 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorizedStoreRequest $request)
    {
        $validated = $request->validated();

        $authorized = Authorized::create($validated);

        return response([
            'authorized' => new AuthorizedResource($authorized),
            'message' => 'Created Successfully'
        ], 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Authorized  $authorized
     * @return \Illuminate\Http\Response
     */
    public function show(Authorized $authorized)
    {
        return response([
            'authorized' => new AuthorizedResource($authorized),
            'message' => 'Retrieved Successfully'
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Authorized  $authorized
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorizedUpdateRequest $request, Authorized $authorized)
    {
        $authorized->update($request->all());

        return response([
            'authorized' => new AuthorizedResource($authorized),
            'message' => 'Retrieved Successfully'
        ], 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Authorized  $authorized
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authorized $authorized)
    {
        $authorized->delete();
        return response (['message' => 'Deleted Successfully'], 200);
    }
}
