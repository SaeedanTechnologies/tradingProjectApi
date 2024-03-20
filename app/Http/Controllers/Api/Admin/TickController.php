<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\{ExceptionHandlerHelper, PaginationHelper};
use Illuminate\Http\Request;
use App\Models\Tick;

class TickController extends Controller
{
   
    public $model;

    public function __construct()
    {
        $this->model = new Tick();
    }
    
    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tick = $this->model::query();
            $groups = PaginationHelper::paginate(
                $tick,
                $request->input('per_page', 10),
                $request->input('page', 1)
            );
            return $this->sendResponse($groups, 'All Tick');
        });
    }



    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $tick = $this->model::create([
                'name' => $request->name,
                'open' => $request->open,
                'high' => $request->high,
                'close'  => $request->close,
                'low' => $request->low
            ]);
            if ($tick) {
                return $this->sendResponse($tick, 'Tick Store Successfully');
            }
        });
    }


    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tick = $this->model::find($id);
            return $this->sendResponse($tick, 'Single Tick');
        });
    }


    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $tick = $this->model::find($id);
            $update = $tick->update([
                'name' => $request->name ?? $tick->name,
                'open' => $request->open ?? $tick->open,
                'high' => $request->high ?? $tick->high,
                'close'  => $request->close ?? $tick->close,
                'low' => $request->low ?? $tick->low
            ]);
            if ($update) {
                return $this->sendResponse($tick, 'Tick Update Successfully');
            }
        });
    }

    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $tick = $this->model::find($id)->delete();
            return $this->sendResponse($tick, 'Tick Deleted');
        });
    }
}