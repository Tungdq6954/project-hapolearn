<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DocumentUser;
use App\Models\Lesson;
use App\Models\LessonUser;

class DocumentController extends Controller
{
    public function learn(Request $request)
    {
        $isLearnedDocument = is_null(DocumentUser::query()->isLearned($request->documentId, Auth::id(), $request->lessonId)->first()) ? false : true;
        $isLearnedLesson = is_null(LessonUser::query()->isLearned(Auth::id(), $request->lessonId)->first()) ? false : true;

        if (!$isLearnedDocument) {
            DocumentUser::create([
                'document_id' => $request->documentId,
                'user_id' => Auth::id(),
                'lesson_id' => $request->lessonId,
            ]);
        }

        if (!$isLearnedLesson) {
            LessonUser::create([
                'lesson_id' => $request->lessonId,
                'user_id' => Auth::id(),
            ]);
        }

        /**
         * do if(!$isLearnedDocument) update bang document_users
         */
        $percentage = Lesson::find($request->lessonId)->progress;

        if ($percentage == 100) {
            $lesson = Lesson::find($request->lessonId);
            $lesson->users()->updateExistingPivot(Auth::id(), ['learned' => 1]);
        }

        /**
         * do if(!$isLearnedLesson) update table lesson_users
         */
        $lesson = Lesson::find($request->lessonId);
        $updateLearners = count($lesson->users);

        return response()->json([
            'percentage' => $percentage,
            'updateLearners' => $updateLearners
        ]);
    }
}
