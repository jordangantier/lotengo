// Variables Globales
const idUser = document.getElementById("idUser");
const nitValue = document.getElementById("nit");
const loadNitUI = document.getElementById("loadNit");
const nombre = document.getElementById("nombre");
const fechaNacimiento = document.getElementById("fechaNacimiento");
const avisoNit = document.getElementById("avisoNit");
const agregarFactura = document.getElementById("agregarFactura");
const monto = document.getElementById("monto");
const comercio = document.getElementById("comercio");
const displayFacturasAcumuladas = document.getElementById(
    "displayFacturasAcumuladas"
);
const sumaFacturas = document.getElementById("sumaFacturas");
const cantidadDeCartones = document.getElementById("cantidadDeCartones");
const montoFaltante = document.getElementById("montoFaltante");
const siguienteUno = document.getElementById("siguienteUno");
const siguienteDos = document.getElementById("siguienteDos");
const anteriorUno = document.getElementById("anteriorUno");
const nuevoRegistro = document.getElementById("nuevoRegistro");
const cartonesFaltantes = document.getElementById("cartonesFaltantes");
const serieCarton = document.getElementById("serieCarton");
const btnSerie = document.getElementById("btnSerie");
const avisoRegistro = document.getElementById("avisoSerie");
const mensajeFinal = document.getElementById("mensajeFinal");
const displayCartonesHabilitados = document.getElementById(
    "displayCartonesHabilitados"
);
const cartonesPorHabilitar = document.getElementById("cartonesPorHabilitar");
const printDiv = document.getElementById("print");
const btnPasoUno = document.getElementById("btnPasoUno");
const btnPasoDos = document.getElementById("btnPasoDos");
const btnPasoTres = document.getElementById("btnPasoTres");
const telefono = document.getElementById("telefono");
const email = document.getElementById("email");
const btnImprimir = document.getElementById("btnImprimir");

let idParticipante = "";
let cartonesAdescontar = 0;
let seriesHabilitadas = [];
const montosFacturas = [];
let fecha = new Date()
    .toLocaleString()
    .replace(",", "")
    .replace(/:.. /, " ")
    .replace("/", "-")
    .replace("/", "-");
btnImprimir.addEventListener("click", () => {
    fetch(`/api/datosimpresion/${nitValue.value}`)
        .then((response) => response.json())
        .then((data) => {
            printDiv.innerHTML = `<table class="customTable">
<thead>
<tr>
<th colspan="2"><strong>REGISTRO CLIENTES</strong></th>
<th colspan="2"><strong>LBS/MKT/ASIF <br>INFORMACIONES</strong></th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>CLIENTE</strong></td>
<td>${data[0].nombre}</td>
<td><strong>ASIF</strong></td>
<td>${data[0].usuario}</td>
</tr>
<tr>
<td><strong>TELEFONO</strong></td>
<td>${data[0].telefono}</td>
<td><strong>CI o NIT</strong></td>
<td>${data[0].ci_nit}</td>
</tr>
<tr>
<td><strong>CAMPAÑA</strong></td>
<td>Lotengo!</td>
<td><strong>E-MAIL</strong></td>
<td>${data[0].email}</td>
</tr>
<tr>
<td><strong>MONTO TOTAL FACTURAS</strong></td>
<td>Bs.- ${data[0].monto_acumulado}</td>
<td><strong>CANT. CARTONES</strong></td>
<td>${data[0].qty_boletos}</td>
</tr>
<tr>
<td><strong>Nº DE REGISTRO</strong></td>
<td>${data[0].id_transaccion}</td>
<td><strong>CARTONES HABILITADOS</strong></td>
<td>${JSON.parse(data[0].habilitados)
                .map((value) => {
                    return value;
                })
                .join(", ")}</td>
</tr>
<tr style="height: 100px;">
<td><strong>FECHA</strong></td>
<td>${data[0].fecha}</td>
<td><strong>FIRMA CLIENTE</strong></td>
<td></td>
</tr>
</tbody>
</table>`;
            printContent();
        })
        .catch((error) => {
            console.log(error);
        });
});

monto.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        //e.preventDefault();
        addFactura(e);
        comercio.focus();
    }
});
serieCarton.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        //e.preventDefault();
        loadSerie();
    }
});
function leerDatosCartones() {
    fetch("/api/habilitados")
        .then((response) => response.json())
        .then((data) => {
            cartonesPorHabilitar.innerText = `Cartones por habilitar: ${data.length}`;
        })
        .catch((error) => console.log(error));
}
leerDatosCartones();
btnSerie.addEventListener("click", () => {
    loadSerie();
});

nitValue.addEventListener("blur", () => {
    loadNit();
});

agregarFactura.addEventListener("click", addFactura);

displayCartonesHabilitados.addEventListener("click", function (e) {
    if (e.path[0].alt === "Eliminar_Codigo") {
        eliminarSerie(e.path[3].firstChild.childNodes[0].innerHTML);
        cartonesFaltantes.innerText = cartonesAdescontar += 1;
    }
});

displayFacturasAcumuladas.addEventListener("click", function (e) {
    if (e.target.alt === "Eliminar") {
        const rc = confirm("¿Seguro que desea Eliminar?");

        if (rc) {
            eliminarFactura(e.path[3].firstChild.childNodes[0].innerHTML);
        }
    }
    if (e.target.alt === "Editar") {
        editarFactura(e.path[3].firstChild.childNodes[0].innerHTML);
    }
});

siguienteUno.addEventListener("click", function () {
    if (
        nitValue.value !== "" &&
        nombre.value !== "" &&
        fechaNacimiento.value !== "" &&
        telefono.value !== "" &&
        email.value !== "" &&
        calcularCartones(sumarFacturas()) > 0
    ) {
        let edad = calcularEdad(fechaNacimiento.value);
        if (edad >= 18) {
            printDiv.innerHTML = `Nombre: ${nombre.value} <br> Nit o CI: ${nitValue.value} <br> Fecha de Nacimiento: ${fechaNacimiento.value} <br> Telefono: ${telefono.value} <br> Edad: ${edad} <br>`;
            goToSection("pasoDos", "btnPasoDos");
        } else {
            alert("el participante debe ser mayor de edad");
        }
        //guardarCliente();
    } else {
        alert("Debe ingresar todos los datos del cliente");
    }
});
anteriorUno.addEventListener("click", function () {
    goToSection("pasoUno", "btnPasoUno");
});

siguienteDos.addEventListener("click", function () {
    if (cartonesFaltantes.innerText == 0) {
        guardarCliente();
        avisoFinal();
        leerDatosCartones();
        goToSection("pasoTres", "btnPasoTres");
    } else {
        alert("Debe habilitar todos los cartones");
    }
});

goToSection("pasoUno", "btnPasoUno");
//goToSection('pasoDos', 'btnPasoDos');
// Funciones
function addFactura(e) {
    e.preventDefault();
    if (comercio.value && monto.value) {
        if (monto.value >= 70) {
            montosFacturas.push({
                comercio: comercio.value,
                monto: monto.value,
                id: montosFacturas.length,
            });
            pintarFacturas();
            sumaFacturas.innerText = `Bs.- ${sumarFacturas()}`;
            cantidadDeCartones.innerText = calcularCartones(sumarFacturas());
            montoFaltante.innerHTML = calcularMontoFaltanteParaMasCartones();
            cartonesFaltantes.innerText = calcularCartones(sumarFacturas());
            cartonesAdescontar = calcularCartones(sumarFacturas());
        } else {
            alert("El monto debe ser mayor a 70");
        }
    } else {
        alert("Debe ingresar un comercio y el monto de la factura");
    }
}
function editarFactura(factura) {
    let index = montosFacturas.findIndex((element) => element.id == factura);
    let respuestaPrompt = prompt(
        "Editar el monto de la factura",
        montosFacturas[index].monto
    );
    if (respuestaPrompt) {
        montosFacturas[index].monto = respuestaPrompt;
        sumaFacturas.innerText = sumarFacturas();
        cantidadDeCartones.innerText = calcularCartones(sumarFacturas());
        montoFaltante.innerHTML = calcularMontoFaltanteParaMasCartones();
        pintarFacturas();
    }
}

function eliminarFactura(factura) {
    let index = montosFacturas.findIndex((element) => element.id == factura);
    montosFacturas.splice(index, 1);
    sumaFacturas.innerText = sumarFacturas();
    cantidadDeCartones.innerText = calcularCartones(sumarFacturas());
    montoFaltante.innerHTML = calcularMontoFaltanteParaMasCartones();
    pintarFacturas();
}

function pintarFacturas() {
    comercio.value = "";
    monto.value = "";
    displayFacturasAcumuladas.innerHTML = "";
    montosFacturas.forEach((element) => {
        const comercio = element.comercio;
        const monto = element.monto;
        const id = element.id;
        displayFacturasAcumuladas.innerHTML += `<tr class="bg-stone-200 border-b"><th scope="row" class="
              py-1
              px-6
              font-medium
              text-gray-900
              uppercase
              whitespace-nowrap
            "><p hidden>${id}</p><b>${comercio}</b> Bs.- ${monto}</th><td class="
              py-1
              px-6
              flex
              justify-end
              items-center
              gap-2
            "><button type="button" class="
                text-lg text-black
                hover:text-blue-600
                transition
                ease-in
                duration-150
              "><img src="img/pencil.svg" alt="Editar"></button><button type="button" class="
                text-lg text-black
                hover:text-red-600
                transition
                ease-in
                duration-150
                eliminar
              "><img src="img/trash.svg" alt="Eliminar" /></button></td></tr>`;
    });
}

function pintarNumerosDeSerie() {
    displayCartonesHabilitados.innerHTML = "";
    seriesHabilitadas.forEach((element) => {
        displayCartonesHabilitados.innerHTML += `<tr class="bg-stone-200 border-b"><th scope="row" class="
              py-1
              px-6
              font-medium
              text-gray-900
              uppercase
              whitespace-nowrap
            "><p hidden>${element}</p>SERIE Nº${element}</th><td class="
                py-1
                px-6
                flex
                justify-end
                items-center
                gap-2
              "><button type="button" class="
                  text-lg text-black
                  hover:text-red-600
                  transition
                  ease-in
                  duration-150
                "><img src="img/trash.svg" alt="Eliminar_Codigo"></button></td></tr>`;
    });
}

function sumarFacturas() {
    let suma = 0;

    montosFacturas.forEach((element) => {
        suma += parseInt(element.monto);
    });

    return suma;
}

function calcularCartones(suma) {
    let cartones = 0;
    if (suma > 0) {
        cartones = Math.floor(suma / 700);
    }
    return cartones;
}

function calcularMontoFaltanteParaMasCartones() {
    let montoFaltante = 0;
    if (sumarFacturas() > 0) {
        if (sumarFacturas() % 700 > 0) {
            montoFaltante = 700 - (sumarFacturas() % 700);
        }
    }
    if (montoFaltante <= 70 && montoFaltante !== 0) {
        montoFaltante = 70;
    }
    if (montoFaltante === 0) {
        montoFaltante = 700;
    }
    let cartones = calcularCartones(sumarFacturas()) + 1;

    return `<div class="bg-blue-500 text-stone-50 text-xs px-3 py-2 font-medium mt-4"><p> Te falta Bs.- ${montoFaltante} para poder canjear ${
        cartones === 1 ? `${cartones} cartón` : `${cartones} cartones`
    }</p></div>`;
}

function eliminarSerie(serie) {
    let index = seriesHabilitadas.findIndex(
        (element) => element.serie === serie
    );
    seriesHabilitadas.splice(index, 1);
    pintarNumerosDeSerie();
}

//funcion toogle style 3 elementos

// Funciones para el manejo de la base de datos

function loadNit() {
    fetch("/api/participantes")
        .then((response) => response.json())
        .then((data) => {
            const found = data.find(
                (element) => element.ci_nit == nitValue.value
            );
            if (found) {
                nombre.value = found.nombre;
                fechaNacimiento.value = found.fecha_nac;
                idParticipante = found.id;
                telefono.value = found.telefono ? found.telefono : "0";
                email.value = found.email ? found.email : "@";
                avisoNit.innerText = "";
                nombre.disabled = true;
                fechaNacimiento.disabled = true;
                telefono.disabled = found.telefono===0?false:true;
                email.disabled = found.telefono==='@'?false:true;
            } else {
                avisoNit.innerText =
                    "¡El NIT no se encontró en la base de datos!.";
                nombre.value = "";
                fechaNacimiento.value = "";
                nombre.disabled = false;
                fechaNacimiento.disabled = false;
                telefono.disabled = false;
                email.disabled = false;
            }
        })
        .catch((error) => {
            alert("Error al consultar el CI o NIT: " + error);
        });
}
function loadSerie() {
    //consultar el numero de serie existe
    if (serieCarton.value === "" || cartonesAdescontar === 0) {
        alert("Debe ingresar un numero de serie");
    } else {
        fetch("/api/habilitados")
            .then((response) => response.json())
            .then((data) => {
                const found = data.find(
                    (element) => element.serie == serieCarton.value
                );
                if (found) {
                    let index = seriesHabilitadas.find(
                        (element) => element == serieCarton.value
                    );

                    seriesHabilitadas.length > 0 ? index : (index = false);
                    if (!index) {
                        aviso(true);
                        cartonesFaltantes.innerText = cartonesAdescontar -= 1;
                        seriesHabilitadas.push(serieCarton.value);
                        pintarNumerosDeSerie();
                        serieCarton.value = "";
                    } else {
                        alert("La serie ya se encuentra registrada");
                    }
                } else {
                    aviso(false);
                }
            })
            .catch((error) => {
                alert("Error al consultar la serie " + error);
            });
    }
}
function guardarCliente() {
    let textToNumber = seriesHabilitadas.map(function (x) {
        return parseInt(x, 10);
    });

    const options = {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
            id_user: idUser.value,
            nombre: nombre.value,
            ci_nit: nitValue.value,
            fecha_nac: fechaNacimiento.value,
            telefono: telefono.value,
            email: email.value,
            facturas: JSON.stringify(montosFacturas),
            monto_acumulado: sumarFacturas(),
            qty_boletos: calcularCartones(sumarFacturas()),
            id_participante: idParticipante,
            habilitados: JSON.stringify(textToNumber),
        }),
    };

    fetch("/api/insertardata", options)
        .then((response) => response.text())
        .then((response) => console.log(response))
        .catch((err) => console.log(err));
}
//

function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}

// funciones para navecgacion entre sections

function goToSection(section, btnSection) {
    const sections = document.querySelectorAll("section");
    sections.forEach((element) => {
        element.style.display = "none";
    });
    document.getElementById(section).style.display = "block";
    //document.getElementById(btnSection).classList.add('bg-blue-500', 'text-stone-50');
}
// un aviso qeu dure 3 segundos
function aviso(registro = false) {
    if (registro) {
        avisoRegistro.innerHTML = `<div class="bg-green-500 text-stone-50 px-6 py-3 transition ease-in-out duration-250"><p>¡Registro exitoso!</p></div>`;
    } else {
        avisoRegistro.innerHTML = `<div class="bg-red-500 text-stone-50 px-6 py-3 transition ease-in-out duration-250"><p>¡Cartón no disponible!</p></div>`;
    }
    setTimeout(() => {
        avisoRegistro.innerHTML = "";
    }, 3000);
}
function avisoFinal() {
    mensajeFinal.innerHTML = `<div class="bg-green-500 text-stone-50 px-6 py-3"><p>El cliente ${
        nombre.value
    } registró correctamente ${calcularCartones(
        sumarFacturas()
    )} cartones para el
primer sorteo en fecha 15/09/2022</p></div>`;
}

function printContent() {
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById("print").innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
