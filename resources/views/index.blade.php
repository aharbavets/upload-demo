<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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

            .content {
                margin: auto;
                max-width: 600px;
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

            <div class="upload-area center">
                <input type="file"/>
            </div>

            <div class="file-list-area">

                @foreach ($fileTypes as $fileType)

                    <h2>{{$fileType['title']}}</h2>

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
