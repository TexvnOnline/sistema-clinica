doctor.change(function () {
    // Limpiamos ambos campos de input
    date_picker.set('clear');
    time_picker.set('clear');
    //Realizamos la petición ajax
    $.ajax({
        // Ruta para procesar la solicitud
        url: "{{ route('ajax.doctor.disable_dates') }}",
        //Como parámetro enviamos el id del doctor
        data: {
            doctor: doctor.val(),
        },
        // Acciones a realizar si la solicitud es satisfactoria.
        success: function (data) {
            // Limpiamos el campo de tiempo por cualquier cosa.
            time_picker.set('clear');
            // Establecemos la fechas deshabilitadas
            disable_dates = data.disable_dates.split('-');
            dates_count = disable_dates.length;
            disable_dates_arr = []; // Tantas filas como fechas y tres columnas
            // Ahora tenemos que crear nuestro arreglo de dos dimensiones
            $.each(disable_dates, function (i, x) { //Primero recorremos nuestro arreglo de fechas
                //Con split convertimos en arreglo el string indicando el divisor que es la coma
                date_arr = x.split(',');
                //Después declaramos nuestro arreglo de elementos
                elem_arr = [];
                $.each(date_arr, function (j, y) {
                    //Convertimos cada elemento ()y,m,d) a entero
                    elem = parseInt(y);
                    // Añadimos cada elemento a un arreglo
                    elem_arr.push(elem);
                });
                //Después añadimos nuestro arreglo de elementos a nuestro arreglo de fechas
                disable_dates_arr.push(elem_arr);
            });
            //arreglo de days_off
            days_off = data.days_off.split('-');
            $.each(days_off, function (k, z) {
                day = parseInt(z);
                disable_dates_arr.push(day);
            });
            // En este aprtado especificamos las fechas que deseamos deshabilitar
            date_picker.set({
                min: true,
                disable: disable_dates_arr
            });
        }
    });
});
