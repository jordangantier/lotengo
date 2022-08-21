<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Lo Tengo! | las Brisas</title>
    <link rel="stylesheet" href="{{asset ('css/index.css')}}" />
    <link rel="icon" type="image/png" href="{{asset ('img/favicon.png')}}" />
    <script type="module" src="{{asset ('js/applotengo.js')}}"></script>
</head>

<body class="bg-stone-50">
    <div class="min-h-full flex flex-col justify-center items-center bg-stone-50 text-stone-900">
        <header class="w-full pb-4 flex justify-between items-center container">
            <div class="logo">
                <img src="{{asset ('img/logo-lotengo.svg')}}" alt="Lotengo" width="200" style="border: 1px" />
            </div>
            <div class="ml-4 text-sm" id="cartonesPorHabilitar"></div>
            <div class="flex items-center gap-2 ml-8">
                <a class="w-8 h-8 text-3xl" href="{{url('user/profile')}}">
                    <img src="{{asset ('img/user-gear.svg')}}" alt="Perfil" title="Configuración de Usuario" />
                </a>
            </div>
        </header>
        <nav class="text-sm">
            <ul class="flex gap-4 sm:gap-6 md:gap-8 lg:gap-12">
                <li>
                    <p class="relative z-10 border border-blue-500 text-center px-4 py-2 rounded-full after:content-[''] after:absolute after:top-4 after:-right-16 after:w-16 after:h-0.5 after:bg-blue-500 after:z-0" id="btnPasoUno">
                        Ingreso de Facturas
                    </p>
                </li>
                <li>
                    <p class="relative z-20 bg-stone-50 border border-blue-500 text-center px-4 py-2 rounded-full after:content-[''] after:absolute after:top-4 after:-right-16 after:w-16 after:h-0.5 after:bg-blue-500 after:z-0" id="btnPasoDos">
                        Habilitacion de Cartones
                    </p>
                </li>
                <li>
                    <p class="relative z-30 bg-stone-50 border border-blue-500 text-center px-4 py-2 rounded-full" id="btnPasoTres">
                        Finalizado
                    </p>
                </li>
            </ul>
        </nav>
        <main class="mt-8">
            <form action="#">
                <section class="hidden target:flex flex-col items-center px-6 py-3" id="pasoUno">
                    <div class="flex flex-col gap-12">
                        <div class="grid grid-cols-1 grid-rows-2 sm:grid-cols-2 sm:grid-rows-1 divide-y sm:divide-y-0 sm:divide-x divide-stone-400">
                            <div class="pb-4 sm:pb-0 sm:pr-4">
                                <h2 class="text-center text-base font-bold uppercase">
                                    Ingreso de facturas
                                </h2>
                                <div class="mt-4">
                                    <p class="text-sm text-red-500">
                                        ¡Revise que todas las
                                        facturas tengan el mismo
                                        nombre y la sucursal
                                        pertenezca al centro
                                        comercial Las Brisas!.
                                    </p>
                                </div>
                                <div class="h-full mt-2">
                                    <div class="flex flex-col gap-1 justify-start">
                                        <div class="grid grid-cols-[1fr_auto] justify-center items-end">
                                            <div class="flex flex-col gap-1">
                                                <p id="idParticipante" hidden>
                                                    1
                                                </p>
                                                <input type="hidden" id="idUser" value="{{auth()->id()}}" />
                                                <label class="text-sm font-medium uppercase" for="nit">
                                                    NIT o CI
                                                </label>
                                                <div class="flex flex-col gap-1 justify-start">
                                                    <input type="number" class="w-full bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none" id="nit" placeholder="Ingrese el NIT o Carnet de Identidad" />
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <p id="avisoNit" class="text-sm text-green-500"></p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1 justify-start">
                                        <div class="flex flex-col gap-1">
                                            <label class="text-sm font-medium uppercase" for="nombre">Nombre o razón
                                                social</label>
                                            <input type="text" class="bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none required" id="nombre" placeholder="Ingrese el nombre o razón social" />
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1 mt-2">
                                        <label class="text-sm font-medium uppercase" for="fechaNacimiento">Fecha de Naciemiento</label>
                                        <input type="date" class="bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none required" id="fechaNacimiento" />
                                    </div>
                                    <div class="flex flex-col gap-1 mt-2">
                                        <label class="text-sm font-medium uppercase" for="telefono">Número de teléfono</label>
                                        <input type="number" class="bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none required" id="telefono" />
                                    </div>
                                    <div class="flex flex-col gap-1 mt-2">
                                        <label class="text-sm font-medium uppercase" for="email">Correo electrónico</label>
                                        <input type="email" class="bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none required" id="email" />
                                    </div>
                                    <hr />
                                    <div class="mt-6 grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-6">
                                        <div>
                                            <div class="flex flex-col gap-1">
                                                <label class="text-sm font-medium uppercase" for="comercio">Nombre del
                                                    comercio</label>
                                                <input type="text" class="bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none required" id="comercio" list="comercios" />
                                                <datalist id="comercios">
                                                    <option value="AÇAÍ BAR SUPER FOOD"></option>
                                                    <option value="ADIDAS"></option>
                                                    <option value="ALDO"></option>
                                                    <option value="ALVINIES"></option>
                                                    <option value="AS DE COPAS"></option>
                                                    <option value="BABY CORP"></option>
                                                    <option value="BLACK LLAMA"></option>
                                                    <option value="BRASARGENT"></option>
                                                    <option value="BUBBLE GUMMERS"></option>
                                                    <option value="BURGER KING"></option>
                                                    <option value="CANDY CORP/RAINBOW"></option>
                                                    <option value="CANELITA CHEESECAKE FACTORY"></option>
                                                    <option value="CATERPILLAR"></option>
                                                    <option value="CLAUDIA KAREN"></option>
                                                    <option value="COLLOKY"></option>
                                                    <option value="CORTEFIEL"></option>
                                                    <option value="COSMET"></option>
                                                    <option value="CROCS"></option>
                                                    <option value="DAYLIGHT DONUTS BO"></option>
                                                    <option value="DEQUINCE"></option>
                                                    <option value="DIESEL"></option>
                                                    <option value="DONATELLA"></option>
                                                    <option value="DOUMO"></option>
                                                    <option value="EL DEBER"></option>
                                                    <option value="F45 ZONA NORTE"></option>
                                                    <option value="FAIR PLAY"></option>
                                                    <option value="FARMACIA CHAVEZ"></option>
                                                    <option value="FEMENINA"></option>
                                                    <option value="FILI STEIK"></option>
                                                    <option value="FIRST"></option>
                                                    <option value="FLAVOR BURST"></option>
                                                    <option value="FLORERÍA RIVERA"></option>
                                                    <option value="FUNDASMANIA"></option>
                                                    <option value="GREENWASH 360"></option>
                                                    <option value="H2O"></option>
                                                    <option value="HAUSCENTER"></option>
                                                    <option value="HERING"></option>
                                                    <option value="LA IBERICA/HERSHEY"></option>
                                                    <option value="HIJOS DE RAMON"></option>
                                                    <option value="HIPERMAXI"></option>
                                                    <option value="HOT BURGER"></option>
                                                    <option value="IMPULSE"></option>
                                                    <option value="INES ESPAÑA"></option>
                                                    <option value="ISLA VIVA"></option>
                                                    <option value="JOYERÍA CARRASCO"></option>
                                                    <option value="JOYERIA PARIS"></option>
                                                    <option value="JOYERIA RICHARDIN"></option>
                                                    <option value="JOYERÍA TAURO"></option>
                                                    <option value="KATANA"></option>
                                                    <option value="KAWKA"></option>
                                                    <option value="KOVI"></option>
                                                    <option value="LA BARRA"></option>
                                                    <option value="LA BARRICA ALLTRADE"></option>
                                                    <option value="LA CALESITA"></option>
                                                    <option value="LA CASA DEL CAMBA"></option>
                                                    <option value="LA DOCE"></option>
                                                    <option value="LA GANGA"></option>
                                                    <option value="LA PARISIENNE KETOCHICS"></option>
                                                    <option value="LA PAVLOVA"></option>
                                                    <option value="LACOSTE"></option>
                                                    <option value="LADY POSH"></option>
                                                    <option value="LOLA Y LOKA"></option>
                                                    <option value="LOMOS GRILL"></option>
                                                    <option value="MADERA"></option>
                                                    <option value="MANJAR DE ORO"></option>
                                                    <option value="MARCAS LIDER LUPO"></option>
                                                    <option value="MAYBELLINE"></option>
                                                    <option value="MESTIZO"></option>
                                                    <option value="MINISO"></option>
                                                    <option value="MITSUBA"></option>
                                                    <option value="MED"></option>
                                                    <option value="MONALISA BIER HAUS"></option>
                                                    <option value="MONSTER WINGS"></option>
                                                    <option value="MULTICINE"></option>
                                                    <option value="NUTREXPLOSION"></option>
                                                    <option value="ÓPTICA PRECISIÓN"></option>
                                                    <option value="OSHKOSH / KID COLLECTION"></option>
                                                    <option value="PACHA WOODS"></option>
                                                    <option value="PANINO"></option>
                                                    <option value="PEDRO DEL HIERRO"></option>
                                                    <option value="POKE POKE"></option>
                                                    <option value="POLLOS CHUY"></option>
                                                    <option value="POLO RALPH LAUREN"></option>
                                                    <option value="POUNDERS"></option>
                                                    <option value="PREMIER FITNESS CLUB"></option>
                                                    <option value="PRUNE"></option>
                                                    <option value="PSYCHO BUNNY"></option>
                                                    <option value="PUERTO MILANESA"></option>
                                                    <option value="PUKET"></option>
                                                    <option value="PUMA"></option>
                                                    <option value="PURIFICACIÓN GARCIA"></option>
                                                    <option value="REVLON"></option>
                                                    <option value="ROCK AND BOWL"></option>
                                                    <option value="ROKYS"></option>
                                                    <option value="ROSEN"></option>
                                                    <option value="SAMSUNG"></option>
                                                    <option value="SAYUBU"></option>
                                                    <option value="SBARRO"></option>
                                                    <option value="SBC"></option>
                                                    <option value="SCARPE"></option>
                                                    <option value="SPRINGFIELD"></option>
                                                    <option value="STARBUCKS"></option>
                                                    <option value="SUBWAY"></option>
                                                    <option value="TANG"></option>
                                                    <option value="TEXTILÓN"></option>
                                                    <option value="TOTTO"></option>
                                                    <option value="TOUS"></option>
                                                    <option value="TROPICAL TOURS"></option>
                                                    <option value="UNDER ARMOUR"></option>
                                                    <option value="VACA FRÍA"></option>
                                                    <option value="VACA FRÍA GOURMET"></option>
                                                    <option value="WOMEN´SECRET"></option>
                                                    <option value="YUTH KIDS"></option>
                                                    <option value="BOBA"></option>
                                                    <option value="NUTRIGO"></option>
                                                </datalist>
                                            </div>
                                            <div class="flex flex-col gap-1 mt-2">
                                                <label class="text-sm font-medium uppercase" for="monto">MONTO DE LA
                                                    FACTURA</label>
                                                <div class="flex flex-wrap lg:flex-nowrap gap-4">
                                                    <input type="number" class="w-full lg:w-auto bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none required" id="monto" />
                                                    <button id="agregarFactura" type="button" class="w-full lg:w-auto bg-blue-500 text-stone-50 text-sm px-4 py-2 rounded-md hover:bg-blue-600 transition ease-in duration-150">
                                                        Agregar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-stone-300 text-stone-900 px-4 py-2 rounded-md">
                                            <div class="mb-2">
                                                <h3 class="uppercase text-sm font-medium">
                                                    Acumulado:
                                                </h3>
                                                <p class="text-2xl" id="sumaFacturas">
                                                    Bs.- 0
                                                </p>
                                            </div>
                                            <hr />
                                            <div class="mt-2">
                                                <h3 class="uppercase text-sm font-medium">
                                                    Cartones:
                                                </h3>
                                                <p class="text-2xl text-center font-medium" id="cantidadDeCartones">
                                                    0
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="montoFaltante"></div>
                                </div>
                            </div>
                            <div class="pt-4 sm:pt-0 sm:pl-4">
                                <h2 class="text-center text-base font-bold uppercase">
                                    Facturas acumuladas
                                </h2>
                                <div class="bg-stone-300 mt-4">
                                    <div class="overflow-x-auto relative">
                                        <table class="w-full text-sm text-left text-gray-500">
                                            <tbody id="displayFacturasAcumuladas"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <a id="siguienteUno" class="bg-green-400 px-4 py-2 uppercase rounded-md text-sm hover:bg-green-500 transition ease-in duration-150">
                                Siguiente
                            </a>
                        </div>
                    </div>
                </section>

                <section id="pasoDos" class="hidden target:flex flex-col items-center px-6 py-3">
                    <div class="flex flex-col gap-12">
                        <div class="flex flex-col divide-y divide-stone-700">
                            <div class="flex flex-col gap-2 pb-4">
                                <h2 class="text-center text-base font-bold uppercase">
                                    Habilitación de cartones
                                </h2>
                                <div class="grid grid-cols-[auto_1fr] gap-2">
                                    <div class="bg-stone-300 text-stone-900 flex flex-col justify-center items-center gap-2 px-4 py-2 rounded-md">
                                        <h3 class="uppercase text-sm font-medium">
                                            Cartones
                                        </h3>
                                        <p class="text-5xl" id="cartonesFaltantes">
                                            0
                                        </p>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label class="text-sm font-medium uppercase" for="serieCarton">Número de serie:</label>
                                        <div class="flex flex-col gap-2">
                                            <input type="text" class="bg-stone-300 text-stone-900 px-3 py-2 rounded outline-none" id="serieCarton" />
                                            <button id="btnSerie" type="button" class="bg-blue-500 text-stone-50 text-sm h-full px-4 py-2 rounded-md">
                                                Habilitar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="avisoSerie"></div>
                            </div>
                            <div class="pt-4">
                                <div>
                                    <h2 class="text-center text-base font-bold uppercase">
                                        Cartones habilitados
                                    </h2>
                                    <div class="min-h-full bg-stone-300">
                                        <div class="overflow-x-auto relative">
                                            <table class="w-full min-h-full text-sm text-left text-gray-500">
                                                <tbody id="displayCartonesHabilitados">
                                                    <tr class="bg-stone-200 border-b"></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center gap-8">
                            <a id="anteriorUno" class="bg-green-400 px-4 py-2 uppercase rounded-md text-sm hover:bg-green-500 transition ease-in duration-150">
                                Anterior
                            </a>
                            <a id="siguienteDos" class="bg-green-400 px-4 py-2 uppercase rounded-md text-sm hover:bg-green-500 transition ease-in duration-150">
                                Registrar
                            </a>
                        </div>
                    </div>
                </section>

                <section id="pasoTres" class="hidden target:flex flex-col gap-12 justify-center items-center">
                    <div id="mensajeFinal" class="max-w-md text-center">
                        <p></p>
                    </div>
                    <div>
                        <span id="btnImprimir"><img src="/img/print.svg" alt="Imprimir" width="50" style="margin: 30px auto;"></span>
                    </div>
                    <div>
                        <div>
                            <a href="{{route('dashboard')}}" class="bg-green-400 px-4 py-2 mt-6 block text-stone-50 uppercase rounded-md text-sm text-center hover:bg-green-500 transition ease-in duration-150">
                                Nuevo registro
                            </a>
                        </div>
                </section>
            </form>
        </main>
    </div>
    <div id="print" hidden style="padding: 262px 13px 71px 313px; width: 595px; height: 396px"></div>
</body>
<style>
    /* body {
    font-family: 'Poppins', sans-serif;
    } */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

</html>
