<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrackingRequest;
use App\Http\Resources\TrackingResource;
use App\Services\Contracts\TrackingServiceContract;
use Exception;

class TrackingController extends Controller
{
    public function __construct(protected TrackingServiceContract $trackingService)
    {
    }

    public function index()
    {
        $user = auth()->user();

        $trackings = $this->trackingService->getAll($user->id);
        
        return TrackingResource::collection($trackings);
    }

    public function store(TrackingRequest $request)
    {
        $input = $request->all();

        try {
            $tracking = $this->trackingService->create($input, auth()->user());
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Falha. Tente novamente.'
            ], $e->getCode());
        }

        return new TrackingResource($tracking);
    }

    public function show($id)
    {
        $user = auth()->user();

        try {
            $tracking = $this->trackingService->get($id, $user->id);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Falha. Tente novamente.'
            ], $e->getCode());
        }

        return new TrackingResource($tracking);
    }

    public function update(TrackingRequest $request, $id)
    {
        $input = $request->all();

        $user = auth()->user();

        $input['user_id'] = $user->id;

        try {
            $tracking = $this->trackingService->update($id, $input);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Falha. Tente novamente.'
            ], $e->getCode());
        }

        return new TrackingResource($tracking);
    }

    public function destroy($id)
    {
        $user = auth()->user();

        try {
            $this->trackingService->delete($id, $user->id);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Falha. Tente novamente.'
            ], $e->getCode());
        }

        return response()->json('Ok');
    }
}
