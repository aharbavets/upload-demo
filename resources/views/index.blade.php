<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload Files Demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            h1 {
                margin-top: 30px;
            }

            .content {
                margin: 0 auto 100px;
                max-width: 800px;
            }

            .title {
                font-size: 84px;
                text-align: center;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .center {
                text-align: center;
            }

            .table-bordered {
                border-collapse: collapse;
            }

            .table-bordered th, .table-bordered td {
                padding: 5px 10px;
                border: 1px solid gray;
            }

            .table-full-width {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="title">
                Upload Files
            </div>

            <form class="upload-area center" method="post" action="/upload">
                @csrf

                <div class="form-group">
                    <input class="form-control" type="file" required/>
                </div>

                <div class="form-group">
                    <label class="control-label" for="user-name"> User Name</label>
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
