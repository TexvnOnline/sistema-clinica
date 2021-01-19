
{!! Html::script('pickadate/picker.js') !!}
{!! Html::script('pickadate/picker.date.js') !!}
{!! Html::script('pickadate/picker.time.js') !!}
{!! Html::script('pickadate/legacy.js') !!}
<script type="text/javascript">


    var input_date = $('.datepiker').pickadate({
        min: true,
        formatSubmit: 'yyyy-m-d',
    });
    var date_picker = input_date.pickadate('picker');
    var input_time = $('.timepiker').pickatime({
        min: 4,
        formatSubmit: 'HH:i',
    });
    var time_picker = input_time.pickatime('picker');

  

    @if (!isset($appointment))
    var speciality = $('#speciality');
    var doctor = $('#doctor');
    speciality.change(function(){
        $.ajax({
            url: "{{route('ajax.user_speciality')}}",
            method: 'GET',
            data:{
                speciality: speciality.val(),
            },
            success: function(data){
                doctor.empty();
                doctor.append('<option disabled selected>-- Selecciona un medico --</option>');
                $.each(data, function(index, element){
                    doctor.append('<option value="'+ element.id +'">'+ element.name +'</option>' )
                });
                {{--  doctor.formSelect();  --}}
            }
        });
    });

    // Esta sentencia se ejecuta cuando el usuario selecciona el médico
    doctor.change(function () {
        // Limpiamos ambos campos de input
        // date_picker.set('clear');
        // time_picker.set('clear');
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
    
    date_picker.on('set', function(){

        //Limpiar la selección
        time_picker.set('clear');
    
        //Ahora debemos realizar una peticion ajax
        $.ajax({
            // Ruta para procesar la solicitud
            url: "{{ route('ajax.doctor.disable_times') }}",
            //Como parámetro enviamos el id del doctor
            data: {
                doctor: doctor.val(),
                date: date_picker.get('select', 'yyyy/mm/dd')
            },
            // Acciones a realizar si la solicitud es satisfactoria.
            success: function(data){
                // Procesar el arreglo para definir los intervalos de la fechas
                a_in_H = parseInt(data.hours[data.day]['a_in_H']);
                a_in_i = parseInt(data.hours[data.day]['a_in_i']);
                a_out_H = parseInt(data.hours[data.day]['a_out_H']);
                a_out_i = parseInt(data.hours[data.day]['a_out_i']);
    
                b_in_H = parseInt(data.hours[data.day]['b_in_H']);
                b_in_i = parseInt(data.hours[data.day]['b_in_i']);
                b_out_H = parseInt(data.hours[data.day]['b_out_H']);
                b_out_i = parseInt(data.hours[data.day]['b_out_i']);
    
                // Vamos a crear un arreglo vacío que va a almacenar las restricciones, tanto de las citas como los horarios del doctor
                disable_hours_arr = [];
    
                // Vamos a retornar el json_string con las citas 
                appointments = JSON.parse(data.appointments);
    
                // Vamos a darle formato al arreglo de las horas que debemos deshabilitar
                $.each(appointments, function(i, x){
    
                    //Creamos un arreglo vacio para para el formato de [Hora,minuto]
                    $time_arr = [];	
                    // Creamos un objeto de tipo Date
                    d = new Date(x['date']);
                    
                    // Añadimos la hora y minuto para el arreglo
                    $time_arr.push(d.getHours());
                    $time_arr.push(d.getMinutes());
    
                    // Añadimos el arreglo completo a nuestro arreglo general para deshabilitar horas
                    disable_hours_arr.push($time_arr);
                    
                });
    
                // Esta es nuestra hora que ya habíamos trabajado en la leccion pasada
                disable_hours_arr.push({ from: [a_out_H, a_out_i], to: [b_in_H, b_in_i] });
    
                // En este aprtado especificamos las fechas que deseamos deshabilitar
                time_picker.set({
                    //Definimos los límites máxismos y mínimos
                    min: [a_in_H, a_in_i],
                    max: [b_out_H, b_out_i],
    
                    // Finalmente deshabilitamos todo lo necesario
                    disable: disable_hours_arr,
                });
            }
        });	
    });

    @endif
   
    

</script>