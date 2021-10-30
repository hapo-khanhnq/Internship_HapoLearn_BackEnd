@extends('admin.index')
@section('content')
<h1 class="mt-4">Course: {{ $lesson->course->name }} / Lesson: {{ $lesson->name }}</h1>
<hr>
<h2 class="m-3">Document List</h2>
<a class="btn btn-primary m-3" id="uploadDocumentButton" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-plus-circle"></i>&nbsp; Add new document</a>
<div class="collapse" id="collapseExample">
    <div class="card card-body mx-3">
       <h3>Upload new document</h3>
       <form action="{{ route('admin.document.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <input type="hidden" name="lessonId" value="{{ $lesson->id }}">
            <div class="form-group">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Document name..." name="name" value="{{ old('name') }}" id="uploadDocumentName">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control select2-menu @error('type') is-invalid @enderror" name="type" id="uploadDocumentType">
                    <option value="">Type</option>
                    <option value="Lesson" @if (request('type')=='Lesson') selected @endif>Lesson</option>
                    <option value="PDF" @if (request('type')=='PDF') selected @endif>PDF</option>
                    <option value="Video" @if (request('type')=='Video') selected @endif>Video</option>
                </select>

                @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">File:</label>
                <input type="file" class="pt-1 form-control @error('file') is-invalid @enderror" name="file" id="uploadDocumentFile">
                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>
<div class="p-3">
    <table class="table table-striped table-bordered table-hover" id="userDataTable">
        <thead>
            <tr class="text-center">
                <th class="w-50">Name</th>
                <th class="w-25">Type</th>
                <th class="w-25">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr class="text-center">
                    <td class="w-50">
                        {{$document->name}}
                    </td>
                    <td class="w-25">
                        @if (isset($document->type))
                            @if ($document->type == "Lesson")
                                <img src="{{ asset('images/doc_file_icon.png') }}" alt="doc_file_icon" class="iconfile-img mr-3"> {{ $document->type }}
                            @elseif ($document->type == "PDF")
                                <img src="{{ asset('images/pdf_file_icon.png') }}" alt="pdf_file_icon" class="iconfile-img mr-3"> {{ $document->type }}
                            @else
                                <img src="{{ asset('images/video_file_icon.png') }}" alt="video_file_icon" class="iconfile-img mr-3"> {{ $document->type }}
                            @endif
                        @else
                            <img src="{{ asset('images/user_avatar.png') }}" alt="default_file_icon" class="iconfile-img"> {{ $document->type }}
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('admin.document.details', $document->id) }}" target="_blank" class="btn btn-success mx-2"><i class="fas fa-tv"></i></a>
                        <a href="{{ route('admin.document.download', $document->file_path) }}" class="btn btn-primary mx-2"><i class="fas fa-download"></i></a>
                        <button type="submit" class="btn btn-danger mx-2" id="deleteDocument" data-toggle="modal" data-target="#exampleModal" data-user="{{ $adminUser->id }}" data-course="{{ $document->id }}" data-url="{{ route('admin.document.destroy', $document->id) }}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('admin.lesson.modal_delete_document')
</div>
@endsection
