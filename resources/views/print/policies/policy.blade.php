<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Poliza</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    {{-- <link rel="shortcut icon" href="./resources/images/LOGO 500X110 FONDO BLANCO.ico" type="image/x-icon"> --}}
    <style>
        @media print {


            html,
            body {
                font-size: 12pt;
                margin: 0;
                padding: 0;
            }
        }

        .page-break {
            width: 980px;
            margin: 0 auto;
        }

        .cabecera-head {
            margin: 0px;
            text-align: center;
        }

        .cabecera-head h4,
        .cabecera-head strong {
            padding: 10px 10px;
            display: block;
        }

        .cabecera-head h4 {
            margin: 0;
            border-bottom: 1px solid #ffffff;
        }

        .cabecera-head img {
            width: 100px;
            height: 100px;
            margin: 0;
        }

        .cabecera-header img {
            width: 150px;
            height: 150px;
            margin: 0;
        }

        .cabecera-head {

            white-space: nowrap;
        }

        .cabecera-head h4 {}


        .imprimir-head {
            margin: 20px 0;
            text-align: left;
        }

        .imprimir-subhead {
            text-align: center;
        }

        .imprimir-head h4,
        .sale-head strong {

            display: block;
        }

        .imprimir-head h4 {
            margin: 0;
            border-bottom: 1px solid #212121;
        }

        .table>thead:first-child>tr:first-child>th {
            border-top: 1px solid #000;
        }

        table thead tr th {
            text-align: center;
            border: 1px solid #ededed;
        }

        table tbody tr td {
            vertical-align: middle;
        }

        .imprimir-head,
        table.table thead tr th,
        table tbody tr td,
        table tfoot tr td {
            border: 1px solid #212121;
            white-space: nowrap;
        }

        .imprimir-head h4,
        table thead tr th,
        table tfoot tr td {
            background-color: #f8f8f8;
        }

        tfoot {
            color: #000;
            font-weight: 500;
        }

        .table-borderless {
            border: 0;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
            border-bottom: 0px;
            border-color: #ffffff;
        }
    </style>
</head>

<body onload="window.print();">
    {{-- <div class="page-break ocultar">
        <a href="index.php" class="btn btn-primary">Volver</a>
    </div> --}}
    <div class="page-break">
        <div>
            <div class="cabecera-header" style="position: absolute;">
                <img src="{{ asset('img/mp_logo.jpg') }}" class="" alt="" srcset="">
            </div>


            <div class="cabecera-head text-center">
                <h4><b>CAJA DE AHORROS PARA OBREROS Y MONTE DE PIEDAD</b></h4>

                <h5><b>P??LIZA DE EMPE??O AL PORTADOR</b></h5>

                <h5>RNC: 401007632 </h5>
                <strong>Surcursal {{ $policy->branch_office->name }}</strong>

                <br>
            </div>

            <div class=" pull-right" style="">
                <center> <img class="img" src="<? echo $cod1esDir.$codeFile?>" style="margin-top: 2%;" /></center>

                <center>
                    <h4 class="mb-2">P??liza no. {{ $policy->number_policy }} &nbsp &nbsp
                        &nbsp</h4>
                </center>

                <h6 style="padding-left:5%;">Fecha de Emisi??n: {{ date('d-m-Y', strtotime($policy->date_start)) }} </h6>

                <h6 style="padding-left:5%;">Fecha Venc: {{ date('d-m-Y', strtotime($policy->date_end)) }} </h6>
            </div>
        </div>

        <div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>


            <p style="text-align: justify"> Yo <b>{{ $policy->clients->name . ' ' . $policy->clients->lastname }}</b>,
                portador del documento de identidad
                <b>{{ $policy->clients->cedula }}</b> en calidad de propietario de la(s) prenda(s) descrita(s), descargo
                de toda
                responsabilidad a Monte de Piedad, si a la(s) misma(s), le fuese detectado alg??n error, ya sea de peso o
                de sus componentes qu??micos, durante permanezca el empe??o o posterior al mismo.
            </p>


            <br>
            <ul>
                @foreach ($policyDetails as $item)
                    <li> {{ $item->description . ' ; Peso: ' . $item->weight . ' ; Gramo:  ' . $item->carat }}</li>
                @endforeach

            </ul>
            <br>
        </div>


        <table class="table table-border">
            <thead>
                <tr>
                    <th class="">Monto Prestado</th>
                    <th class="desc" style="">RD$ {{ number_format($policy->loan_value, 2) }}</th>
                </tr>
            </thead>
        </table>

        <br>


        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <center>
                        <br>

                        ___________________________________________
                        <br>
                        Firma del Solicitante
                    </center>

                </div>
                <div class="col-sm">
                    <center>
                        <br>

                        ___________________________________________
                        <br>
                        Representante de Monte de Piedad
                    </center>
                </div>

            </div>
            <div class="row" style="margin-top: 5%; border-style: groove; border-radius: 10px;">
                {{-- if($poliza[0]["VIGENCIA"]==12)
           <p style="font-size: 14px; text-align: justify;">
             Efectos de indemnizaci??n: con una valoraci??n previa de la prenda o prendas, que ser?? el valor por el que fue 
             tasada la prenda y ser?? cubierto al 100% por Monte de Piedad, que ser??a de obligatoria aplicaci??n en caso de 
             extrav??o de estas. 
             </p>
           <p style="font-size: 14px; text-align: justify;">
             Luego de transcurrir dos (02) a??os sin haber realizado renovaci??n, las prendas pasar??n a subasta publica.
             </p>
         else --}}
                <div class="col">
                    <ol style="font-size: 10px; text-align: justify;">
                        <li>- La p??liza constituye para su poseedor la unica prueba del contrato de empe??o, pactado con
                            la institucion; es un titulo
                            al portador, transmisible por simple entrega y debe ser conservada sin enmiendas, borraduras
                            o raspaduras. Su posesi??n implica
                            la aceptaci??n de todas las condiciones indicadas en ellas, as?? como las contenidas en la Ley
                            ??rganica de la Caja de Ahorros para Obreros
                            y Monte de Piedad, Reglamentos y Disposiciones Interiores de la Institucion.
                        </li>
                        <li>- Las prendas podr??n ser desempe??adas antes del vencimiento, pero no el mismo d??a que se
                            efectu?? la operaci??n; los intereses se computar??n
                            los meses nominales; al {{ $policy->interest_rate }} % mensual, toda fracci??n del mes se
                            considerar?? como mes
                            completo para el c??mputo de los mismos.
                        </li>
                        <li>- La renovaci??n deber?? ser solicitada el d??a del vencimiento de la p??liza, pero nunca antes
                            de la fecha de su vencimiento. Esta renovaci??n podr??
                            ser rechazada o admitida por una suma que puede ser igual, superior o inferior al pr??stamo
                            anterior, a juicio exclusivo de la Administraci??n y siempre a base de una nueva valoraci??n
                            de la prenda.</li>
                        <li>- Dentro del mes siguiente al del vencimiento, las cosas que constituyen la prenda
                            ser??n vendidas en p??blica subasta en la fecha y lugar que designe el Administrador,
                            la cual ser?? anunciada por la prensa con quince d??as de antelaci??n. El precio de
                            primera puja de los bienes muebles que ser?? puesto en subasta ser?? fijado libremente
                            por el Administrador; pero nunca ser?? menor del conjunto de los valores adecuados
                            a la Instituci??n por concepto de la operaci??n que di?? origen a la prenda, incluyendo
                            los gastos o reparaciones hechos con cargo a la misma.

                        </li>
                        <li>- EXCEDENTES DE REMATE.- Del producto del remate se reducir??n el pr??stamo,
                            intereses, gastos y derechos de remate, y el excedente estar?? a disposici??n del
                            poseedor de la P??liza Correspondiente a los bienes subastados durante los seis meses
                            siguientes a la fecha de la venta en p??blica subasta. El excedente prescribir?? una vez
                            transcurrido el plazo anterior y su importe ingresar?? a la Instituci??n.</li>
                        <li>- Los bienes muebles que no hubieran vendido en p??blica subasta, por falta de licitaciones,
                            ser??n adjudicados a la Instituci??n por el precio de primera puja y pasar??n, en
                            consecuencia, a ser de su propiedad y podr??n ser vendidos de grado a grado o en
                            p??blica subasta por el precio que la Administraci??n considere conveniente.
                        </li>
                    </ol>
                </div>
                <div class="col">
                    <ol style="font-size: 10px; text-align: justify;" start="7">
                        <li>- Tanto los desempe??os como las renovaciones deben efectuarse en la oficina
                            en que se realiz?? la operaci??n de cr??dito, y hasta el tercer dia laborable anterior
                            al fijado para la venta en p??blica subasta de las prendas correspondientes a
                            las P??lizas vencidas.</li>
                        <li>- Es obligaci??n del tenedor de la P??liza, asegurarse de que las cosas consignadas
                            en las mismas est??n completas y exactamente descritas. En el caso de empe??o
                            como en el desempe??o, ninguna reclamaci??n ser?? admitida despu??s que el
                            interesado se haya retirado de las ventanillas.</li>
                        <li>- La Caja de Ahorros para Obreros y Monte de Piedad no responder?? de la p??rdida
                            o deterioro de las cosas dadas en prenda cuando ??stas provengan del tiempo
                            o de la naturaleza misma de las cosas o de casos fortuitos o de fuerza mayor.
                            Para la reparaci??n a que hubiere lugar se tomar?? como base el eval??o consignado
                            en la P??liza Correspondiente atribuido por los Peritos Tasadores de la Instituci??n,
                            al momento de realizarse la operaci??n del pr??stamo, o el doble del saldo
                            adecuado al momento del da??o en los casos en que hubiere entrega a cuentas.</li>
                        <li>-En caso de p??rdida o destrucci??n de la P??liza, el interesado deber?? notificarlo
                            a la Instituci??n mediante declaraci??n jurada y firmada por ??l, debiendo anunciarlo
                            en un peri??dico de circulaci??n nacional, requiriendo a quien lo posea, presentarlo
                            a la Caja de Ahorros y Monte de Piedad en el t??rmino de 15 d??as. Pasado los
                            quince d??as despu??s de la fecha de la denuncia y cinco d??as despu??s del
                            vencimiento de la P??liza, sin que hubiere sido presentada a la Instituci??n la
                            P??liza perdida o destruida, se considerar?? cancelada ??sta, y se podr??n efectuar
                            las operaciones posteriores a que hubiere lugar en favor del denunciante, salvo
                            contestaci??n por parte de terceros.</li>
                        <li>-Se admitir??n entregas a cuentas (abono al pr??stamo) desde RD$5.00 en adelante,
                            independientemente de los intereses, contra recibos que ser?? indispensable
                            devolver conjuntamente con las piezas correspondientes al tiempo de hacerse
                            el desempe??o a la renovaci??n.
                            NOTA: PARA FINES DE RENOVACION.</li>
                        <li>-Al momento de cancelar el contrato, el cliente deber?? pagar una comisi??n de
                            un 2% por los meses de contrato.</li>
                    </ol>


                </div>


            </div>
        </div>


        {{-- </div>
    <div class="page-break">
        <div class="pull-center" style="margin-top: 10px;border-style: dotted; padding: 50px; ">
            <center>
                <img class="img" src="<? echo $codesDir.$codeFile?>" style="margin-top: 2%;" />
              
                <h4>P??liza no. {{$policy->number_policy}} </h4>
               
                <h6 style="padding-left:5%;">Fecha de Emisi??n: {{ date('d-m-Y', strtotime($policy->date_start))}} &nbsp &nbsp &nbsp</h6>
                <h6 style="padding-left:5%;">Fecha Venc: {{ date('d-m-Y', strtotime($policy->date_end))}} &nbsp &nbsp &nbsp</h6>
            </center> 
        </div>
    </div> --}}
</body>

</html>
