<?php

namespace App\Http\Controllers;

use App\{Http\Requests\GoogleFormRequest, Services\Miscellaneous\GoogleFormService};
use Illuminate\Http\{JsonResponse, RedirectResponse};

class GoogleFormController extends Controller
{
    public function __invoke(GoogleFormRequest $request, GoogleFormService $service): JsonResponse|RedirectResponse
    {
        $success = $service->processSubmission($request->validated());

        if (!$success) {
            return $this->error('An error occurred during form processing.');
        }

        return $this->success('Form has been submitted and sanitized successfully.');
    }
}
