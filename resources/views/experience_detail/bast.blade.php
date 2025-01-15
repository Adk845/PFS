<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ public_path('images/bast.png') }}');
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
            height: 90vh; 
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

        .container{
            margin-top: 80px;
            padding: 60px;
        }

        .judul {
            text-align: center; 
            margin-top: 5px; 
        }

        .judul h2 {
            margin-bottom: 0px; 
        }

        .judul p {
            margin-top: 0; 
            font-size: 12px;
        }

        .letak {
            font-size: 15px;
        }
        
       

        p{
            font-size: 15px;
        }

         table.ttd {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            table-layout: fixed; 
        }
        table.ttd td {
            border: 1px solid black;
            padding: 5px 10px; 
            font-size: 15px;
            width: 50%; 
            vertical-align: middle; 
        }
        table.ttd tr:nth-child(2) td {
            height: 85px;
        }
        table.ttd tr:nth-child(3) td {
            height: 15px;
        }

        td{

        vertical-align: top;
        }

        li{
            margin-top: -15px;
        }

      



    </style>
    <title>Certification of Completion</title>
</head>
<body>

<div class="container">

    <div class="judul">
        <h2>CERTIFICATION OF COMPLETIONS</h2>
        <p>Berita Acara Serah Terima Pekerjaan</p>
    </div>

    <div>
         <p> 
          This certificate is to confirm and certify that the below scope of work has been witnessed and completed in accordance with Client specifications and governing all the codes and standards, &nbsp; unless agreed and stated otherwise. 
         </p>
    </div>

    <table class="letak">
    <tr>
        <td>Project No</td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->project_no}}</div></td>                    
    </tr>

    <tr>
        <td>Project Name</td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->project_name}}</div></td>                    
    </tr>

    <tr>
        <td>Client Name</td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->client_name}}</div></td>                    
    </tr>

    <!--<tr>-->
    <!--    <td>Durations (Month)</td>-->
    <!--    <td >:</td>-->
    <!--    <td ><div  style="width: 430px">{{$experiences->durations}}</div></td>-->
        
    <!--</tr>-->

    <tr>
        <td></td>
        <td ></td>
        <td > Date Start : {{$experiences->date_project_start}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Date End :  {{$experiences->date_project_end}}</td>                    
    </tr>

    <tr>
        <td>Area/Locations</td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->locations}}</div></td>                    
    </tr>

    <tr>
        <td>KBLI Number</td>
        <td >:</td>
        <td ><div  style="width: 430px">{{$experiences->kbli_number}}</div></td>                    
    </tr>

    </table>

    <div class= "description">
       
    <p><b>Description of Work/Project:</b>
    <ul>
    <li> {{$experiences->scope_of_work}}</li>
    </ul>
    </p>

    <p><b>Conditions of Handover </b>
   <ul><li>
   All necessary documents and materials related to the work/project have been provided,
    as per contract. Any issues or pending items from the previous phase have been
    discussed, and the receiving party is aware of them.
   </li> </ul>
    </p>

    </div>

    <div>
         <p> 
         By signing this document, both parties confirm that the job handover has been carried out to mutual satisfaction and that the receiving party is now responsible for the continued progress or completion of the work.
         </p>
    </div>

     

    <table class="ttd">
    <tr>
        <td>PT Intra Multi Global Solusi</td>
        <td>Client</td>
    </tr>

    <tr>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td></td>
    </tr>
</table>

</div>

</body>
</html>
