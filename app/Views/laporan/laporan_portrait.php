<!DOCTYPE html>
<html lang="en">

<head>

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Times New Roman", Times, serif; */
    }

    table {
        border-collapse: collapse;
        vertical-align: top;
        /* overflow: wrap; */
        font-size: 10pt;

    }

    table.table-border-0 tr td {
        border-collapse: collapse;
        border: 0px solid;
        word-wrap: break-word;
        padding: 2px;

    }

    table.main-table {
        color: #000;
        border: 1px solid;
    }

    table.main-table td,
    th {
        border: 1px solid #232323;
        padding: 3px 3px 3px 3px;
        word-wrap: break-word;
    }

    tr.row-border td {
        border-bottom: 1pt solid #000;
    }

    td.border-right-0,
    th.border-right-0 {
        border-right: 0px;
    }

    td.border-left-0 {
        border-left: 0px;
    }
    </style>


</head>

<body>
    <table width="100%" style="margin-top:-40px">
        <tr>
            <td>
                <img width="60px" src="<?=base_url().'/public/img/logo_kpu.png'?>">
            </td>
            <td colspan="11" style="text-align:center; ">
                <p>
                    <b style="font-size: 16pt;"><?='KOMISI PEMILIHAN UMUM<br/>'.strtoupper($kabkota)?></b>
                    <br />
                    <?=$alamat
                  .'<br/>Surel: '.$email
                  .'&nbsp; Website: '.$website
                  .'<br/> <b style="font-size: 13pt">'.strtoupper($ibukota) .'</b>'
                  ?>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="12" style="border-bottom:1.5px solid #000 "></td>
        </tr>
    </table>
    <p></p>
    <?=$view?>

</body>

</html>