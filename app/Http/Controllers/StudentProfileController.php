<?php

namespace App\Http\Controllers;

use App\{Http\Requests\UpdateStudentProfile, Services\ListType\StudentService};
use Exception;
use Illuminate\Http\JsonResponse;

class StudentProfileController extends Controller
{
    public function update(UpdateStudentProfile $request, StudentService $studentService): JsonResponse
    {
        try {
            $studentId = $request->input('student_id');
            $studentService->update($studentId, $request->validated());

            return response()->json(['status' => 'success', 'message' => 'Student profile has been updated successfully!']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
