/**
 * Created by angel on 24/07/2017.
 * metodos ajax para eliminar y editar los cuartos
 */


$(document).ready(function () {
    $(document).on('click','#btndelete',function (e) {
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:Routing.generate('deleteRoom'),
            data:{id: $(this).attr('value')},
            dataType:'json',
            success: function (data)
            {

                console.log('hola'+data);
                if(data.tymes == "success"){
                    var ms= "<div class= 'flash-success alert alert-"+data.tymes+"'  role='alert'>";
                    ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                    ms+="<span aria-hidden='true'>x</span></button>";
                    ms+=data.mensaje;
                    ms+="</div>";
                    $('#mensaje').html(ms);
                    $('#tablediv').html(data.roomslist_html); // presento el mensaje

                }
            },
            error: function (jqXHR,exception)
            {
            }
        });
    });
    //get room
    $(document).on('click','#btnmostrar',function (e) {
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:Routing.generate('editRoom'),
            data:{id: $(this).attr('value')},
            dataType:'json',
            success: function (data)
            {
                $('#modalDet').html(data.roomsform_html);

                $('#modalDetalle').modal('show');
                /*if(data.tymes == "success"){
                    var ms= "<div class= 'flash-success alert alert-"+data.tymes+"'  role='alert'>";
                    ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                    ms+="<span aria-hidden='true'>x</span></button>";
                    ms+=data.mensaje;
                    ms+="</div>";
                    $('#mensaje').html(ms);
                    $('#tablediv').html(data.roomslist_html); // presento el mensaje

                }*/
            },
            error: function (jqXHR,exception)
            {
            }
        });
    })
    $(document).on('submit','#formDet',function (e) {
        e.preventDefault();
        console.log( $(this));
        $.ajax({
            method:"POST",
            url:Routing.generate('editRoom'),
            data:{id: $(this).attr('value'), form: $(this).serialize()},
            dataType:'json',
            success: function (data)
            {
                console.log(data);
                /*if(data.tymes == "success"){
                 var ms= "<div class= 'flash-success alert alert-"+data.tymes+"'  role='alert'>";
                 ms+="<button type='button' class='close' data-dismiss= 'alert' aria-label='Close'>";
                 ms+="<span aria-hidden='true'>x</span></button>";
                 ms+=data.mensaje;
                 ms+="</div>";
                 $('#mensaje').html(ms);
                 $('#tablediv').html(data.roomslist_html); // presento el mensaje
                 }*/
            },
            error: function (jqXHR,exception)
            {
            }
        });
    });
});