<?php

namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use App\Repositories\Api\Admin\SymbelGroupRepository;
use App\Http\Requests\Api\Admin\SymbelGroups\Create as SymbelGroupCreate;
use Illuminate\Http\Request;


class SymbelGroupController extends Controller
{
    protected $symbelGroupRepository;

    public function __construct(SymbelGroupRepository $symbelGroupRepository)
    {
        $this->symbelGroupRepository = $symbelGroupRepository;
    }

    public function index(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $symbelGroups = $this->symbelGroupRepository->getAllSymbelGroups($request);
            return $this->sendResponse($symbelGroups, 'All SymbelGroups');
        });
    }

    public function store(SymbelGroupCreate $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($request) {
            $user = $this->symbelGroupRepository->createSymbelGroup($request->validated());
            return $this->sendResponse($user, 'SymbelGroup created successfully');
        });
    }

    public function show($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $symbelGroup = $this->symbelGroupRepository->findSymbelGroupById($id);
            return $this->sendResponse($symbelGroup, 'Single SymbelGroup');
        });
    }

    public function update(Request $request, $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id, $request) {
            $symbelGroup = $this->symbelGroupRepository->updateSymbelGroup($request, $id);
            return $this->sendResponse($symbelGroup, 'SymbelGroup updated successfully');
        });
    }

    public function destroy($id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use ($id) {
            $this->symbelGroupRepository->deleteSymbelGroup($id);
            return $this->sendResponse([], 'SymbelGroup deleted successfully');
        });
    }
}

