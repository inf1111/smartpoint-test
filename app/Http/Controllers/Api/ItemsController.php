<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ItemRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ItemsController extends Controller
{
    /**
     * Check if item is in registry
     *
     * @param ItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function check(ItemRequest $request) : Response
    {
        $registry = session()->get('registry');

        $inversion = session()->get('inversion');

        $realVal = (in_array($request->id, $registry)) ? true : false;

        $returnVal = ($inversion) ? ! $realVal : $realVal;

        return ($returnVal) ? response(null, 200) : response(null, 404);
    }

    /**
     * Add item to registry
     *
     * @param ItemRequest $request
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function store(ItemRequest $request) : Response
    {
        $id = $request->id;

        $registry = session()->get('registry');

        if (in_array($id, $registry))
        {
            throw ValidationException::withMessages(['id' => 'Item already exists.']); // HTTP status: 422 Unprocessable Content
        }
        else
        {
            $registry[] = $id;

            session()->put('registry', $registry);

            return response(null, 201); // successfully added
        }
    }

    /**
     * Remove item from registry
     *
     * @param ItemRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemRequest $request) : Response
    {
        $id = $request->id;

        $registry = session()->get('registry');

        if (in_array($id, $registry))
        {
            $key = array_search($id, $registry);

            unset($registry[$key]);

            session()->put('registry', $registry);

            return response(null, 204); // successfully deleted
        }
        else
        {
            return response(null, 404); // specified item doesnt exist
        }
    }

    /**
     * Display all registry items
     */
    public function index()
    {
        $registry = session()->get('registry');

        return response()->json($registry, 200);
    }

}
