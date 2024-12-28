<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function kirimFeedback(FeedbackRequest $request)
    {
        $feedback = new Feedback();
        $feedback->create($request->validated());

        return redirect()->route('landing-page')
            ->with('success', 'Feedback berhasil dikirim');
    }
}
