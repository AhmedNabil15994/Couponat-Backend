<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Course\Transformers\Api\{CourseCardResource,MyNoteCardResource};
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Package\Transformers\Api\PackageCardResource;

class UserProfileController extends ApiController
{
    public function myCourses(Request $request)
    {
        return CourseCardResource::collection($request->user()->my_courses->latest()->paginate(10));
    }

    public function myNotes(Request $request)
    {
        return MyNoteCardResource::collection($request->user()->my_notes->latest()->paginate(10));
    }

    public function myPackages(Request $request)
    {
        return PackageCardResource::collection($request->user()->my_packages->latest()->paginate(10));
    }
}
