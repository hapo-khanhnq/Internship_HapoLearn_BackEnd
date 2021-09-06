<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        // $document = new Document();
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('storage\documents', $filename);
        // $document->file_path = $filename;
        // $document->name = $request->name;
        // $document->type = $request->type;
        // $document->lesson_id = $request->lessonId;
        // $document->save();
        Document::create([
            'name' => $request->name,
            'type' => $request->type,
            'file_path' => $filename,
            'lesson_id' => $request->lessonId,
        ]);
        return redirect()->back();
    }

    public function download($file)
    {
        return response()->download(public_path('storage\documents/' . $file));
    }

    public function details($id)
    {
        $document = Document::findOrFail($id);
        return view('document.document_details', compact('document'));
    }

    public function learn(Request $request)
    {
        $document = Document::findOrFail($request->id);
        $lessonId = Document::findOrFail($request->id)->lesson_id;
        $document->students()->updateExistingPivot(Auth::user()->id, array('learned' => config('variables.learned_document')));
        $progressOfLesson = Lesson::findOrFail($lessonId)->learning_progress;
        if ($progressOfLesson == config('variables.lesson_completed')) {
            Lesson::findOrFail($lessonId)->students()->updateExistingPivot(Auth::user()->id, array('learned' => config('variables.learned_lesson')));
        }
        return response()->json([
            'document' => $document,
            'progress' => $progressOfLesson,
        ]);
    }
}
