<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Maker;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests\CreateVehicleRequest;

class MakerVehiclesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth.basic.once', ['except'=>['index', 'show']]);
	}
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
	public function store(CreateVehicleRequest $request, $maker_id)
	{

		$maker = Maker::find($maker_id);



		if(!$maker)
		{
			return response()->json(['message'=>'This maker does not exist.', 'code'=>404], 404);
		}

		$values = $request->all();

		$maker->vehicles()->create($values);

		return response()->json(['message'=>'Vehicle was created.'], 201);

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
	public function update(CreateVehicleRequest $request, $maker_id, $vehicle_id)
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

		$vehicle->color = $request->input('color');

		$vehicle->power = $request->input('power');

		$vehicle->capacity = $request->input('capacity');

		$vehicle->speed = $request->input('speed');

		$vehicle->save();

		return response()->json(['message'=>'Vehicle was updated.'], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($maker_id, $vehicle_id)
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

		$vehicle->delete();

		return response()->json(['message'=>'Vehicle was deleted.'], 200);

	}

}
