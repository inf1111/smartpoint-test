<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DiffRequest;
use Illuminate\Http\JsonResponse;

class RegistryController extends Controller
{
    /**
     * Compares a submitted set to the current set, eg. “diff red,blue,green”.
     * Assuming the current set in the registry contains “yellow, blue”, the diff would return “red, green”.
     *
     * @param DiffRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function diff(DiffRequest $request) : JsonResponse
    {
        $registry = session()->get('registry');

        $returnArr = array_values(array_diff($request->diffArr, $registry));

        return response()->json($returnArr, 200);
    }

    /**
     * Inverts the current set, eg. “invert”. Anything that checks true before the invert should check false, and vice versa.
     * Eg “check brown” is falsy. We do an “invert”. Now “check brown” would be true.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function invert() : JsonResponse
    {
        $inversion = session()->get('inversion');

        $inversion = ! $inversion;

        session()->put('inversion', $inversion);

        $message = "Inversion is now: " . (($inversion) ? "true" : "false");

        return response()->json(['message' => $message], 200);
    }

}
