<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\DataFeedRepository;
use App\Http\Requests\Api\Admin\DataFeeds\Create as DataFeedCreate;
use Illuminate\Http\Request;


class DataFeedController extends Controller
{
    protected $dataFeedRepository;

    public function __construct(DataFeedRepository $dataFeedRepository)
    {
        $this->dataFeedRepository = $dataFeedRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $DataFeeds = $this->dataFeedRepository->getAllDataFeeds($request);
            return $this->sendResponse($DataFeeds, 'All DataFeeds');
        });
    }

    public function store(DataFeedCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->dataFeedRepository->createDataFeed($request->validated());
            return $this->sendResponse($user, 'DataFeed created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $DataFeed = $this->dataFeedRepository->findDataFeedById($id);
            return $this->sendResponse($DataFeed, 'Single DataFeed');
        });
    }

    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $DataFeed = $this->dataFeedRepository->updateDataFeed($request, $id);
            return $this->sendResponse($DataFeed, 'DataFeed updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->dataFeedRepository->deleteDataFeed($id);
            return $this->sendResponse([], 'DataFeed deleted successfully');
        });
    }
}

