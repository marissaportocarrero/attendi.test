@extends('admin.layouts.master')

@section('content')
<div class="container bg-white mt-3 p-5">
    <h1>Reporte por empresas</h1>
    <label for="">Empresas</label>
    <select id="enterprise" style="width: 30%" class="form-control">
        <option value="">--seleccione--</option>
    </select>
</div>

<div class="container bg-white mt-3 p-5">
    <div class="table-responsive">
        <table id="tablereport" class="table">
            <thead>
                <th>Empleado</th>
                <th>Empresa</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Fecha de Inicio</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const selectEmpresa = document.querySelector('#enterprise');
    const tbody = document.querySelector("#tablereport tbody");
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
    getEmpresa();

    $(document).on('change','#enterprise', function(e){
        tableAll(e.target.value)
    });

    async function tableAll(emp){
        const url = "/reportenterprises/all";
        const resp = await fetch(url);
        const res = await resp.json();

        const { reporte } = res;
        // console.log(reporte)
        limpiarHtml()
        reporte.forEach((r)=>{
            const { cargo, departamento, empleado, empresa, fecha } = r;

            const tr = document.createElement('tr');

            if(empresa.toLowerCase() == emp){
                tr.innerHTML = `
                    <td>${empleado}</td>
                    <td>${empresa}</td>
                    <td>${departamento}</td>
                    <td>${cargo}</td>
                    <td>${fecha}</td>
                `;
            }

            tbody.appendChild(tr);

        })
    }
    tableAll();

    function limpiarHtml(){
    while (tbody.firstChild) {
    tbody.removeChild(tbody.firstChild);
    }
    }
</script>
@endsection
