@extends('admin.layouts.master')

@section('cssdatable')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" />
@endsection

@section('content')
<div class="container bg-white mt-3 p-5">
    <h1>Asistencia - Reportes por fecha</h1>
    <div class="d-flex justify-content-between w-100 flex-wrap" style="overflow-x: scroll">
        <form id="formReporte" class="d-flex align-items-center">

            <div class="form-group d-flex align-items-center">
                <label for="finicio" class="label" style="width: 120px; margin-bottom: 0">Fecha Inicio</label>
                <div>
                    <input type="date" id="finicio" name="finicio" class="ml-10 form-control" value="" required>
                    @error('finicio')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group d-flex ml-5 align-items-center">
                <label for="ffinal" class="label" style="width: 120px; margin-bottom: 0">Fecha Final</label>
                <div>
                    <input type="date" id="ffinal" name="ffinal" class="ml-10 form-control" value="" required>
                    @error('ffinal')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group d-flex ml-5 align-items-center">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <div class="d-none justify-content-between" style="margin: 0 0 25px 0;" id="subfiltros">
            <div class="d-flex align-items-center" style="margin-right: 20px">
                <label for="asistencia" style="width: 120px; margin-bottom: 0">Asistencia</label>
                <select id="asistencia" class="form-control">
                    <option value="">seleccione</option>
                    <option value="presente">Presente</option>
                    <option value="ausente">Ausente</option>
                    <option value="tardanza">Tardanza</option>

                </select>
            </div>
            <div class="d-flex align-items-center">
                <label for="empresas" style="width: 120px; margin-bottom: 0">Empresas</label>
                <select id="empresas" class="form-control">
                    <option value="">seleccione</option>
                </select>
            </div>
        </div>
    </div>
</div>
@php
$ct = count($data);
@endphp
<div class="container bg-white mt-3 p-5">
    <div class="table-responsive">
        <div id="">
            <div>
                <h3>Reporte</h3>
                <div class="d-flex ">
                    <p class="mr-5">Fecha Inicio: <span id="finicios"></span></p>
                    -
                    <p class="ml-5">Fecha Final: <span id="ffinals"></span></p>
                </div>
            </div>
            <table class="table" id="reportg">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                        <th>Asistencia</th>
                        <th>Minutos de tardanza</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('jsdatatable')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('ajax')
<script>
    const tbody = document.querySelector('#reportg tbody');
    const finicio =document.querySelector("#finicios");
    const ffinal =document.querySelector("#ffinals");
    const selectEmpresa = document.querySelector("#empresas");
    const subfiltros= document.querySelector("#subfiltros");

    getEmpresa();

    $("#formReporte").submit(function(e){
        e.preventDefault();
        let finicio = $("#finicio").val();
        let ffinal = $("#ffinal").val();

        tablall(finicio, ffinal)

        if(finicio.textContent != '' && ffinal.textContent != '' ){
        subfiltros.classList.remove('d-none');
        subfiltros.classList.add('d-flex')
        }
    });

    $(document).on("change",'#asistencia', function(e){
        limpiarHtml()
        console.log(e.target.value);
        const inicio = finicio.textContent;
        const final = ffinal.textContent;
        tablaAsistencia(inicio, final, e.target.value);
    })

    $(document).on("change",'#empresas', function(e){
        limpiarHtml();
        const inicio = finicio.textContent;
        const final = ffinal.textContent;
        console.log(e.target.value)
        tablaEmpresa(inicio, final, e.target.value);
    })

    function tablallenar(inicio, finalf){
        $('#reportg').DataTable({
            destroy:true,
            ajax: {
                method: 'GET',
                url: `/attendance/reportgeneral/store?finicio=${inicio}&ffinal=${finalf}`
            },
            columns: [
                {
                    data: 'enterprises'
                },{
                    data: 'employees',
                },{
                    data: 'date'
                },{
                    data: 'job_input'
                },{
                    data: 'job_output'
                },{
                    data: null,
                    render:function(d,t,r){
                        const horaentrada = new Date(`${d.date} ${d.job_input}`);
                        const hour = parseInt(horaentrada.getHours());
                        const minute = parseInt(horaentrada.getMinutes());
                        const second = parseInt(horaentrada.getSeconds());
                        if(d.attendance == 0){
                            return  'Ausente';
                        }else {
                            if(hour >= 8 && minute > 0 && second > 0){
                                return `Tardanza`;
                            }else {
                                return "Presente "+hour;
                            }
                        }

                    }
                },{
                    data: null,
                    render: function(d,t,r) {
                        const horaentrada = new Date(`${d.date} ${d.job_input}`);
                        const hour = parseInt(horaentrada.getHours());
                        const minute = parseInt(horaentrada.getMinutes());
                        const second = parseInt(horaentrada.getSeconds());

                        if(hour >= 8 && minute > 0 && second > 0){
                            return `${ 8 - hour } : ${ 0 - minute} : ${ 0 - second}`;
                        }else {
                            return "";
                        }
                    }
                }
            ]
        });
    }

    async function tablall(inicio, final){

        const res = await fetch(`/attendance/reportgeneral/store?finicio=${inicio}&ffinal=${final}`);
        const resp = await res.json();
        const { data } = resp;

        finicio.textContent = inicio;
        ffinal.textContent = final;
        limpiarHtml()
        data.forEach((d)=> {
            const {employees, enterprises, date, job_input, job_output, attendance} = d;

            const horaentrada = new Date(`${date} ${job_input}`);
            const hour = parseInt(horaentrada.getHours());
            const minute = parseInt(horaentrada.getMinutes());
            const second = parseInt(horaentrada.getSeconds());
            let tard;
            if(hour >= 8 && minute > 0 && second > 0){
                tard = `${ 8 - hour } : ${ 0 - minute} : ${ 0 - second}`;
            }else {
                tard = "";
            }
            let asist;
            if(attendance == 0){
                asist = 'Ausente';
            }else {
                if(hour >= 8 && minute > 0 && second > 0){
                    asist = `Tardanza`;
                }else {
                    asist = "Presente ";
                }
            }


            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>${enterprises}</td>
                <td>${employees}</td>
                <td>${date}</td>
                <td>${job_input}</td>
                <td>${job_output}</td>
                <td>${asist}</td>
                <td>${tard}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    async function tablaAsistencia(inicio, final, asistencia){

        const res = await fetch(`/attendance/reportgeneral/store?finicio=${inicio}&ffinal=${final}`);
        const resp = await res.json();
        const { data } = resp;

        finicio.textContent = inicio;
        ffinal.textContent = final;
        // limpiarHtml()
        data.forEach((d)=> {
        const {employees, enterprises, date, job_input, job_output, attendance} = d;

        const horaentrada = new Date(`${date} ${job_input}`);
        const hour = parseInt(horaentrada.getHours());
        const minute = parseInt(horaentrada.getMinutes());
        const second = parseInt(horaentrada.getSeconds());
        let tard;
        if(hour >= 8 && minute > 0 && second > 0){
        tard = `${ 8 - hour } : ${ 0 - minute} : ${ 0 - second}`;
        }else {
        tard = "";
        }
        let asist;
        if(attendance == 0){
            asist = 'Ausente';
        }else {
            if(hour >= 8 && minute > 0 && second > 0){
                asist = 'Tardanza';
            }else {
                asist = "Presente";
            }
        }
        const tr = document.createElement('tr');
        if(asistencia == asist.toLowerCase()) {
            tr.innerHTML = `
                <td>${enterprises}</td>
                <td>${employees}</td>
                <td>${date}</td>
                <td>${job_input}</td>
                <td>${job_output}</td>
                <td>${asist}</td>
                <td>${tard}</td>
            `;
        } else if( asistencia == '' ) {
            tr.innerHTML = `
            <td>${enterprises}</td>
            <td>${employees}</td>
            <td>${date}</td>
            <td>${job_input}</td>
            <td>${job_output}</td>
            <td>${asist}</td>
            <td>${tard}</td>
            `;
        }
        tbody.appendChild(tr);

        });
    }

    async function tablaEmpresa(inicio, final, empresa){

        const res = await fetch(`/attendance/reportgeneral/store?finicio=${inicio}&ffinal=${final}`);
        const resp = await res.json();
        const { data } = resp;

        finicio.textContent = inicio;
        ffinal.textContent = final;
        limpiarHtml()
        data.forEach((d)=> {
        const {employees, enterprises, date, job_input, job_output, attendance} = d;

        const horaentrada = new Date(`${date} ${job_input}`);
        const hour = parseInt(horaentrada.getHours());
        const minute = parseInt(horaentrada.getMinutes());
        const second = parseInt(horaentrada.getSeconds());
        let tard;
        if(hour >= 8 && minute > 0 && second > 0){
            tard = `${ 8 - hour } : ${ 0 - minute} : ${ 0 - second}`;
        }else {
            tard = "";
        }
        let asist;
        if(attendance == 0){
            asist = 'Ausente';
        }else {
            if(hour >= 8 && minute > 0 && second > 0){
            asist = `Tardanza`;
            }else {
            asist = "Presente ";
            }
        }

        const tr = document.createElement('tr');


        if(empresa == enterprises.toLowerCase() ){

            tr.innerHTML = `
                <td>${enterprises}</td>
                <td>${employees}</td>
                <td>${date}</td>
                <td>${job_input}</td>
                <td>${job_output}</td>
                <td>${asist}</td>
                <td>${tard}</td>
                `;
        }else if(empresa == '') {
                tr.innerHTML = `
                <td>${enterprises}</td>
                <td>${employees}</td>
                <td>${date}</td>
                <td>${job_input}</td>
                <td>${job_output}</td>
                <td>${asist}</td>
                <td>${tard}</td>
                `;
        }
        tbody.appendChild(tr);
        });
    }

    async function getEmpresa(){
        const url = "/attendance/reportgeneral/getEmpresa";
        const resp = await fetch(url);
        const res = await resp.json();

        const { empresa } = res;

        empresa.forEach((e)=>{
            const {name} = e;
            const option = document.createElement('option');
            option.value= name.toLowerCase();
            option.textContent = name;
            selectEmpresa.appendChild(option);
        });

    }

    function limpiarHtml(){
        while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
        }
    }

</script>
@endsection
