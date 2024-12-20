<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ public_path('images/1.png') }}');
            background-size: cover;     
            background-position: center;    
            background-repeat: no-repeat;
            height: 100vh;  
            width: 100%;    
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



</div>
</body>
</html>
