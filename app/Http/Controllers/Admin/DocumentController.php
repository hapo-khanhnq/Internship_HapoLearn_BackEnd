<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUploadDocumentRequest;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentsUser;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function upload(AdminUploadDocumentRequest $request)
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
        $newDocumentId = Document::orderByDesc('id')->first()->id;
        DocumentsUser::create([
            'document_id' => $newDocumentId,
            'user_id' => Auth::user()->id,
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

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        $documentUser = DocumentsUser::where('user_id', Auth::user()->id)->where('document_id', $document->id);
        $documentUser->delete();
        return redirect()->back();
        return redirect()->route('admin.lessons.show');
    }
}
