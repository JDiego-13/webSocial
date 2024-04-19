document.addEventListener('DOMContentLoaded', function(){
    // Referencia a los elementos HTML
    var diaSelect = document.getElementById('dia');
    var mesSelect = document.getElementById('mes');
    var yearSelect = document.getElementById('year');

    function generarDiaOpcion(){
        var selectedMonth = parseInt(mesSelect.value);
        var selectedYear = parseInt(yearSelect.value);
        var daysInMonth = new Date(selectedYear, selectedMonth, 0).getDate(); // Obtiene el número de días en el mes y año seleccionados
        diaSelect.innerHTML = '<option value="">Día</option>'; // Restablece las opciones de día
        for (var i = 1; i <= daysInMonth; i++){
            diaSelect.innerHTML += '<option value="' + i + '">' + i + '</option>'; // Agrega las opciones de día al elemento select
        }
    }

    function generarYearOpcion(){
        var currentYear = new Date().getFullYear(); // Obtiene el año actual
        yearSelect.innerHTML = '<option value="">Año</option>'; // Restablece las opciones de año
        for (var i = currentYear; i >= currentYear - 100; i--){
            yearSelect.innerHTML += '<option value="' + i + '">' + i + '</option>'; // Agrega las opciones del año al elemento select
        }
    }

    // Establecer valores predeterminados para los campos de selección de fecha
    generarDiaOpcion();
    generarYearOpcion();

    // Agregar oyentes de eventos para los cambios de los campos mes y año.
    mesSelect.addEventListener('change', generarDiaOpcion);
    yearSelect.addEventListener('change', generarDiaOpcion);
});
