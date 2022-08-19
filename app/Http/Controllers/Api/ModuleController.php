<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourse;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index($course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);
        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateModule $request
     * @param $course
     * @return ModuleResource
     */
    public function store(StoreUpdateModule $request, $course): ModuleResource
    {
        $module = $this->moduleService->createNewModule($request->validated());
        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return ModuleResource
     */
    public function show($course, string $identify): ModuleResource
    {
        $module = $this->moduleService->getModuleByCourse($course,$identify);
        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCourse $request
     * @param string $identify
     * @return JsonResponse
     */
    public function update(StoreUpdateModule $request, $course, string $identify)
    {
        $this->moduleService->updateModule($identify, $request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($course, $identify)
    {
        $this->moduleService->deleteModule($identify);
        return response()->json([], 204);
    }
}
