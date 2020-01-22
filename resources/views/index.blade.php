<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload Files Demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="content">
            <div class="title">
                Upload Files
            </div>

            <form class="upload-area" method="post" action="/upload">
                @csrf

                <div class="form-group">
                    <label class="control-label" for="user-name">File</label>
                    <input class="form-control" type="file" required/>
                </div>

                <div class="form-group">
                    <label class="control-label" for="user-name">User Name</label>
                    <input id="user-name" class="form-control" type="text" required>
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-primary">Upload</button>
                </div>
            </form>

            <div class="file-list-area">
                <div class="title">
                    Uploaded Files
                </div>

                @foreach ($fileTypes as $fileType)

                    <h1>{{$fileType['title']}}</h1>

                    <table class="table-bordered table-full-width">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Upload Date</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fileType['files'] as $file)
                                <tr>
                                    <td>{{$file['name'] ?? ''}}</td>
                                    <td>{{$file['size'] ?? ''}}</td>
                                    <td>{{$file['upload_date'] ?? ''}}</td>
                                    <td>{{$file['user_name'] ?? ''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endforeach

            </div>
        </div>
    </body>
</html>
