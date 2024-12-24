<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Experiences</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            page-break-before: always;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #f4f4f4;
        }
        .header {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .images img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>All Experiences</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Project No</th>
                    <th>Project Name</th>
                    <th>Client Name</th>
                    <th>KBLI number</th>
                    <th>Category</th>
                    <th>Durations</th>
                    <th>Period</th>
                    <th>Locations</th>
                    <th>Scope of Work</th>
                    <th>Status</th>
                    <th>Images</th>
                </tr>
            </thead>
            <tbody>
                @foreach($experiences as $index => $experienceDetail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $experienceDetail->project_no }}</td>
                        <td>{{ $experienceDetail->project_name }}</td>
                        <td>{{ $experienceDetail->client_name }}</td>
                        <td>{{ $experienceDetail->kbli_number }}</td>
                        <td>{{ $experienceDetail->category }}</td>
                        <td>{{ $experienceDetail->durations }}</td>
                        <td>{{ $experienceDetail->date_project_start }} - {{ $experienceDetail->date_project_end }}</td>
                        <td>{{ $experienceDetail->locations }}</td>
                        <td>{{ $experienceDetail->scope_of_work }}</td>
                        <td>{{ $experienceDetail->status }}</td>
                        <td class="images">
                        @foreach($experienceDetail->images as $image)
    <img src="{{ public_path('storage/' . $image->foto) }}" alt="image">
@endforeach

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
