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
            padding-top: 100px;
            padding-bottom: 50px;
        }

        .container {
            width: 100%;
            padding: 5px;
            margin-top: -20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px; /* Reduced font size */
        }

        th,
        td {
            padding: 3px; /* Reduced padding */
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle; /* Aligning text and images vertically in the center */
        }

        th {
            background-color: #006ec1;
            color: white;
            text-align: center;
        }

        /* Styling the images to be aligned to the left side of the cell */
        td img {
            max-width: 70px; /* Reduced image size */
            height: 60px; /* Explicit height to prevent images from expanding row */
            object-fit: contain; /* Ensures the image scales within its container */
            display: inline-block;
            margin-right: 5px; /* Space between image and next content (if any) */
        }

        /* Prevent image overflow and ensure alignment */
        td {
            overflow: hidden;
            text-align: left; /* Align images to the left */
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }
        }

        .header {
            position: fixed;
            top: -20;
            left: 0;
            right: 0;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            border-bottom: 1px solid black;
            background-color: #fff;
        }

        .header img {
            height: 60px;
        }

        .header .title {
            text-align: right;
            font-size: 18px;
            color: black;
            margin-left: 20px;
            margin-top: -40px;
        }

        .footer {
    position: fixed;
    bottom: -30px; /* Menurunkan footer lebih jauh */
    left: 0;
    width: 100%;
    padding: 10px;
    text-align: left;
    font-size: 12px;
    border-top: 1px solid black;
    font-weight: bold;
    box-sizing: border-box;
}


        .footer .page-number:before {
            content: "Page " counter(page);
        }

        .footer .title {
            text-align: center;
            font-size: 12px;
            color: #006ec1;
            margin-top: -40px;
        }

        .footer .title2 {
    text-align: right;
    font-size: 12px;
    color: black;
    margin-top: -40px;
}

.footer .title2 img {
    width: 70px; /* Ukuran gambar QR yang lebih kecil */
    height: auto; /* Menjaga proporsi gambar */
}


        .status-finished {
            background-color: green;
            color: white;
        }

        .status-on-progress {
            background-color: rgb(254, 206, 0);
            color: white;
        }

        .page-break {
            page-break-before: always;
        }
        
    </style>
</head>

<body>

<div class="footer">
    <div class="page-number"></div>
    <div class="title"><b>Grand Galaxy City Jl. Cordova 3 Blok RGC3 No.58 <br>
    Jaka Setia – Bekasi Selatan – Jawa Barat 17147 <br>
    © December 2024 I-solutions Indonesia. All rights reserved.</b></div>
    <div class="title2"><img src="{{ public_path('images/QR.png') }}" alt="qr"></div>
</div>


    <div class="header">
        <img src="{{ public_path('images/ISOLUTIONS.png') }}" alt="Logo">
        <div class="title"><b>Isolutions Indonesia</b><br>All Experiences - {{ date('F Y') }}</div>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Status</th>
                    <th>Project No</th>
                    <th>Project Name</th>
                    <th>Client Name</th>
                    <th>KBLI Number</th>
                    <th>Category</th>
                    <th>Durations</th>
                    <th>Period</th>
                    <th>Locations</th>
                    <th>Scope of Work</th>
                    <th>Images</th>
                </tr>
            </thead>
            <tbody>
                @foreach($experiences as $index => $experienceDetail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $experienceDetail->status }}
                        </td>
                        <td>{{ $experienceDetail->project_no }}</td>
                        <td>{{ $experienceDetail->project_name }}</td>
                        <td>{{ $experienceDetail->client_name }}</td>
                        <td>{{ $experienceDetail->kbli_number }}</td>
                        <td>{{ $experienceDetail->category }}</td>
                        <td>{{ $experienceDetail->durations }}</td>
                        <td>{{ $experienceDetail->date_project_start }} - {{ $experienceDetail->date_project_end }}</td>
                        <td>{{ $experienceDetail->locations }}</td>
                        <td>{{ $experienceDetail->scope_of_work }}</td>
                        <td>
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
