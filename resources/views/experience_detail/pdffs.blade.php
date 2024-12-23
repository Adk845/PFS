<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ public_path('images/2.png') }}');
            background-size: cover;     
            background-position: center;    
            background-repeat: no-repeat;
            height: 100vh;  
            width: 100%;    
            font-size: 18px;
        }

        .content {
            padding: 20px;
            color: #333;
        }

        @page {
            size: A4;
            margin: 0;
        }

        .container_konten {
            margin-top: 80px;
            display: flex;
            justify-content: space-between; 
            align-items: flex-start; 
        }

        .letak{
            margin-top: 170px;
            margin-left: 70px;
        }

        .image-wrapper {
            margin-top: 48px;
            display: flex;
            flex-wrap: wrap;  
            gap: 20px;  
            margin-left: 60px;
            width: 80%;  
        }

        .image-wrapper img {
            width: 31%;  
            height: auto;  
            object-fit: cover; 
            margin-top: 10px;

        }

        .image-wrapper img:nth-child(4),
        .image-wrapper img:nth-child(5) {
            width: 47%;  
            height: 25%;  
        }

        td{

            vertical-align: top;
        }

    </style>
    <title>Document</title>
</head>
<body>
<div class="container_konten">
<table class="letak">
    <tr>
        <td><b>Category</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->category}}</div></td>                     
    </tr>

    <tr>
        <td><b>Status</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->status}}</div></td>                    
    </tr>

    <tr>
        <td><b>Project No</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->project_no}}</div></td>                    
    </tr>

    <tr>
        <td><b>Project Name</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->project_name}}</div></td>                    
    </tr>

    <tr>
        <td><b>Client Name</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->client_name}}</div></td>                    
    </tr>

    <tr>
        <td><b>Durations</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->durations}}</div></td>
        
        
    </tr>

    <tr>
        <td><b>Date Project Start</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->date_project_start}}</div></td>                    
    </tr>

    <tr>
        <td><b>Finish Date</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->date_project_end}}</div></td>                    
    </tr>

    <tr>
        <td><b>Area/Locations</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->locations}}</div></td>                    
    </tr>

    <tr>
        <td><b>KBLI Number</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->kbli_number}}</div></td>                    
    </tr>

    <tr>
        <td><b>Scope Of Works</b></td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->scope_of_work}}</div></td>                    
    </tr>
</table>

<table>
        <tr>
            <td colspan="5">
                <div class="image-wrapper">
                    <!-- Images, first 3 in the top row, last 2 in the bottom -->
                    <img src="{{ public_path('storage/' . $images[0]->foto) }}" alt="Image 1">
                    <img src="{{ public_path('storage/' . $images[1]->foto) }}" alt="Image 2">
                    <img src="{{ public_path('storage/' . $images[2]->foto) }}" alt="Image 3">
                    <img src="{{ public_path('storage/' . $images[3]->foto) }}" alt="Image 4">
                    <img src="{{ public_path('storage/' . $images[4]->foto) }}" alt="Image 5">
                </div>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
