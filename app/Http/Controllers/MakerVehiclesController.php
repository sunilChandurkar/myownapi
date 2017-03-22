<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Maker;
use App\Vehicle;
use Illuminate\Http\Request;

class MakerVehiclesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$maker = Maker::find($id);

		if(!$maker)
		{
			return response()->json(['message'=>'This maker does not exist.', 'code'=>404], 404);
		}

		return response()->json(['data'=>$maker->vehicles], 200);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($maker_id, $vehicle_id)
	{
		$maker = Maker::find($maker_id);

		if(!$maker)
		{
			return response()->json(['message'=>'This maker does not exist.', 'code'=>404], 404);
		}

		$vehicle = $maker->vehicles->find($vehicle_id);

		if(!$vehicle)
		{
			return response()->json(['message'=>'This vehicle does not exist.', 'code'=>404], 404);
		}

		return response()->json(['data'=>$vehicle], 200);
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
