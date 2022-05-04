@extends('admin.layouts.master')

@section('content')

<div class="container bg-white mt-3 p-5">
    <h1>Empleados</h1>
    <button type="button" class="btn btn-primary" id="crear" data-toggle="modal" data-target="#employeeCard">
        Registrar Empleado
    </button>
</div>

<div class="container bg-white mt-3 p-5">
    <div class="table-responsive">
        <table class="table" id="emptable">
            <thead>
                <tr>
                    <th>Apellidos y Nombres</th>
                    <th>D.N.I.</th>
                    <th>Telefono</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Genero</th>
                    <th>Estado Civil</th>
                    <th>Direccion</th>
                    <th>Correo Electronico</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection

<div class="modal fade" id="employeeCard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formemployee">
                    @csrf
                    {{-- @method('put') --}}
                    <input type="hidden" id="id">
                    <div class="form-group">
                        <label for="">Apellidos y Nombres:</label>
                        <input type="text" class="form-control" name="nomap" id="nomap" value="">

                    </div>
                    <div class="form-group">
                        <label for="">D.N.I.</label>
                        <input type="text" class="form-control" name="dni" id="dni" value="">

                    </div>
                    <div class="form-group">
                        <label for="">Correo Electronico</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="">Telefono: </label>
                        <input type="tel" class="form-control" name="telefono" id="telefono" value="">

                    </div>
                    <div class="form-group">
                        <label for="">Fecha de Nacimiento: </label>
                        <input type="date" class="form-control" name="fechanac" id="fechanac" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Genero</label>
                        <select id="genero" name="genero" class="form-control">
                            <option value="">--seleccione--</option>
                            <option value="1">MASCULINO</option>
                            <option value="2">FEMENINO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Estado civil</label>
                        <select id="civilestado" name="civilestado" class="form-control">
                            <option value="">--seleccione--</option>
                            <option value="1">SOLTERO</option>
                            <option value="2">CASADO</option>
                            <option value="3">VIUDO</option>
                            <option value="4">DIVORCIADO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Direccion</label>
                        <input type="text" class="form-control mb-2" name="direccion" id="direccion">
                        <div id="map" style="height:250px;"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Estado</label>
                        <select id="estado" name="estado" class="form-control">
                            <option value="">--seleccione--</option>
                            <option value="1">ACTIVO</option>
                            <option value="0">INACTIVO</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('apimaps')

<script>
    const body = document.querySelector("#emptable tbody");
    const keyapi = "AAPK8383d78163c6459eb21982e932fc4228OfOz0PRJy1wrsIMUi0KpFeeVO8dZDvh6RAdJDBs_JL2M5PzBhFnCYZHfU8pqywbg";
    $(document).on('click','#edit', function(e){
        limpiar()
        const id = e.target.dataset.id;
        getEmployee(id);
    })

    $(document).on('click','#crear', function(){
        limpiar();
        mapa()
    })

    $("#formemployee").submit(function(e){
        e.preventDefault();
        const name = $("#nomap").val();
        const dni = $("#dni").val();
        const tel = $("#telefono").val();
        const fecha = $("#fechanac").val();
        const genero = $("#genero").val();
        const civilest = $("#civilestado").val();
        const direc = $("#direccion").val();
        const estado = $("#estado").val();
        const email = $("#email").val();
        const id = $("#id").val();
        if(name == '' || dni == '' || email == '' || tel == '' || fecha == '' || genero == '' || civilest == '' || direc == '' || estado == '' ) {
            alert('Completar campos');
        }

        const data = new FormData();
        data.append('name',name);
        data.append('dni',dni);
        data.append('email', email);
        data.append('telefono', tel);
        data.append('fecha', fecha);
        data.append('genero', genero);
        data.append('civilest', civilest);
        data.append('direccion', direc);
        data.append('estado', estado);

        if(id == '') {
            addEmployee(data);
        } else {
            const data = {
                id: id,
                name: name,
                dni: dni,
                email: email,
                telefono: tel,
                fecha: fecha,
                genero: genero,
                civilest: civilest,
                direccion: direc,
                estado: estado,
                _token:$("meta[name='csrf-token']").attr('content')
            }
            updateEmployee(data,id);
        }
    })

    async function addressMap(lng, lat){
        const url = `https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/reverseGeocode?f=json&location=${lng},${lat}`;
        const resp = await fetch(url);
        const res = await resp.json();

        const { address, location } = res;
        const {AddNum, Address, Block, City, CntryName} = address;
        console.log(res);
        const direccion = `${Address}, ${City}`;
        $("#direccion").val(direccion);
        // $("#lat").val(lat);
        // $("#lng").val(lng);
    }

    async function addEmployee(data){
        const url = `/employee/store`;
        const resp = await fetch(url, {
            method: 'POST',
            headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }, body: data
        });
        const res = await resp.json();

        const { msg } = res;

        swal({
            icon: "success",
            title: msg
        })
        tablAll()
        $("#employeeCard").modal('hide')
    }

    async function updateEmployee(data,ide){
        const url= `/employee`;
        $.ajax({
            url: url,
            data: data,
            type: 'PUT',
            success: function(data) {
                const { msg} = data
                swal({
                icon: "success",
                title: msg
                })
                tablAll()
                $("#employeeCard").modal('hide')
            }
        })
    }

    async function getEmployee(ide) {
        const url = `/employee/${ide}`;
        const resp = await fetch(url);
        const res = await resp.json();

        const { id,name, dni, cellphone, gender, civil_status, telephone, address, status, email, birth } = res.employee;

        $("#nomap").val(name);
        $("#dni").val(dni);
        $("#telefono").val(cellphone);
        $("#fechanac").val(birth);
        $("#genero").val(gender);
        $("#civilestado").val(civil_status);
        $("#direccion").val(address);
        $("#estado").val(status);
        $("#email").val(email);
        $("#id").val(id);
        getLocation(address);
    }

    function limpiar(){
        $("#nomap").val('');
        $("#dni").val('');
        $("#telefono").val('');
        $("#fechanac").val('');
        $("#genero").val('');
        $("#civilestado").val('');
        $("#direccion").val('');
        $("#estado").val('');
        $("#email").val('');
        $("#id").val('');
    }

    async function getLocation(search){
        const url = `https://geocode-api.arcgis.com/arcgis/rest/services/World/GeocodeServer/findAddressCandidates?address=${search}&maxLocations=1&f=json&token=${keyapi}`;
        const resp = await fetch(url);
        const res = await resp.json();
        console.log(res.candidates);
        const { candidates } = res;

        candidates.forEach((c) => {
            const { x, y } = c.location;
            const slat = x;
            const slng = y;

            mapa(slng,slat)

        } )

    }

    function mapa(lng = -12.215, lat = -76.939){

        var map = L.map('map').setView([lng, lat], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let marker;

        // Agregar el pin
        marker = new L.marker([lng, lat], {
        draggable: true,
        autoPan: true
        })
        .addTo(map);

        // Geocode Service
        const geocodeService =L.esri.Geocoding.geocodeService();

        marker.on("moveend", function(e){

        marker = e.target;

        const posicion = marker.getLatLng();

        //
        map.panTo(new L.LatLng(posicion.lat, posicion.lng));

        addressMap(posicion.lng,posicion.lat);
        })
    }

    async function tablAll(){
        const url = `/employees/all`;
        const resp = await fetch(url);
        const res = await resp.json();

        const { employees } = res;
        limpiarHtml()
        employees.forEach((emp)=> {
            const {id, name, dni, cellphone, birth, gender, civil_status,address,email, status} = emp;

            var genero;
            if(gender == 1){
                genero = 'MASCULINO';
            }else if(gender == 2) {
                genero = 'FEMENINO';
            }else {
                genero = 'NO REGISTRO'
            }

            var estadocivil;

            if(civil_status == 1 || civil_status == 0){
                estadocivil = "SOLTERO"
            } else if( civil_status == 2) {
                estadocivil = "CASADO"
            } else if( civil_status == 3) {
                estadocivil = "VIUDO"
            } else if( civil_status == 4) {
                estadocivil = "DIVORCIADO"
            }

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${name}</td>
                <td>${dni}</td>
                <td>${cellphone}</td>
                <td>${birth}</td>
                <td>${genero}</td>
                <td>${estadocivil}</td>
                <td>${address}</td>
                <td>${email}</td>
                <td>${status}</td>
                <td>
                    <button type="button" class="btn btn-primary" id="edit" data-toggle="modal" data-target="#employeeCard"
                        data-id="${id}">Editar</button>
                </td>
            `;

            body.appendChild(tr);
        });
    }

tablAll()

function limpiarHtml(){
    while (body.firstChild) {
    body.removeChild(body.firstChild);
    }
}

</script>

@endsection
