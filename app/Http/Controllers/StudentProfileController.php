<?php

namespace App\Http\Controllers;

use App\{Http\Requests\UpdateStudentProfile, Models\Student, Services\ListType\StudentService};
use Exception;
use Illuminate\Http\{JsonResponse, RedirectResponse};

class StudentProfileController extends Controller
{
    public function update(UpdateStudentProfile $request, StudentService $studentService): JsonResponse|RedirectResponse
    {
        try {
            $studentService->update($request->validated());
            $student = Student::where('student_id', $request->input('student_id'))->first();

            if ($request->expectsJson()) {
                return response()->json(['type' => 'success', 'message' => $this->getUpdatedMessage('Student'), 'student' => $student->fresh()->load('person')->toArray()], 200);
            }

            return $this->success($this->getUpdatedMessage('Student'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
