<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHandlerHelper;
use Illuminate\Http\Request;
use App\Models\User;
use Str;

class BrandController extends Controller
{
    
    public function index()
    {
        return ExceptionHandlerHelper::tryCatch(function () {
            $brands = User::whereHas('roles', function ($query) {
                $query->where('name', 'brand');
            })->get();
            return $this->sendResponse($brands, 'All Brands');
        });
    }

    
    public function store(Request $request)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($request) {
            $password = Str::random(6);
            $brands = User::create([
                'name' => $request->name,
                'email'=> $request->name.'@gmail.com',
                'password' => $password,
                'original_password' => $password
            ]);
            if($brands)
            {
                $brands->assignRole('brand');
                return $this->sendResponse($brands, 'All Store Successfully');
            }
        });
    }

    
    public function show(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($id) {
            $brands = User::find($id);
            return $this->sendResponse($brands, 'Single Brands');
        });
    }

    
    public function update(Request $request, string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($id, $request) {
            $brands = User::find($id);
            $update = $brands->update([
                'name' => $request->name,
                'email'=> $request->name.'gmail.com'
            ]);
            if($update)
            {
                return $this->sendResponse($brands, 'Brands Update Successfully');
            }
        });
    }

    
    public function destroy(string $id)
    {
        return ExceptionHandlerHelper::tryCatch(function () use($id) {
            $brands = User::find($id)->delete();
            return $this->sendResponse([], 'Brands Deleted');
        });
    }
}