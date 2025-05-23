<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Course\Transformers\Api\CourseCardResource;

class FavouriteCourseController extends ApiController
{
    
    public function list(Request $request)
    {
        return CourseCardResource::collection($request->user()->favouriteCourses()->latest()->paginate(10));

    }
    public function favouriteCourse(Request $request, $courseId)
    {
        $toggle = $request->user()->favouriteCourses()->toggle([$courseId]);
        return $this->response([
            'attached' => isset($toggle['attached']) && count($toggle['attached']),
            'course' => $courseId,
        ]);

    }
}
