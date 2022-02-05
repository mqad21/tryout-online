<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\TestAnswer;
use Illuminate\Http\Request;

class TestController extends Controller
{

    /**
     * Submit a test.
     */
    public function submit(Request $request, $id)
    {
        $test = Test::findOrFail($id);
        $answers = collect($request->answers)
            ->filter(function ($optionId) {
                return $optionId != null;
            })
            ->map(function ($optionId) {
                return new TestAnswer(['question_option_id' => $optionId]);
            });
        $test->answers()->saveMany($answers);
        $test->done();
        return redirect()->route("tryout.explanation");
    }
}
