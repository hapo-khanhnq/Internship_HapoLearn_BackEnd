<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->name }}</title>
</head>
<body>
    <section class="document-details-section">
        <iframe src="/storage/documents/{{ $document->file_path }}" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0%;left:0px;right:0px;bottom:0px" height="100%" width="100%" frameborder="0"></iframe>
    </section>
</body>
</html>
