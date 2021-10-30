$(document).ready(function(){
    mostrarProductos();

    function mostrarProductos(){
        $.ajax({
            type : 'POST',
            url : url+'empleado/mostrarProductos',
            success : function(response){
                //console.log(response)
                $("#productos tbody").html(response)
            }, 
            error : function(){
                console.log('error ajax')
            }
        })
    }

    // Agregar productos
    $("#btnAdd").click(function(e){
        $("#frmProductos").validetta({
            realTime: true,
            onValid: function(event){
                event.preventDefault();
        var form = $("#frmProductos")
        var method = form.attr('method')
        var action = form.attr('action')
        var data = form.serialize();
        swal.fire({ 
            icon: 'question', 
            title: '¿Esta seguro de agregar un nuevo producto ?',
            showCancelButton: true, 
            confirmButtonText: 'Si, Agregar' 
            }).then(function(result) { 
                    if (result.isConfirmed) { 
                        $.ajax({
                            type : method,
                            url : action,
                            data : data,
                            success: function(response){
                                // console.log(response)
                                var mensaje = (response)?'Producto insertado':'Error al insertar el producto';
                                Swal.fire(mensaje);
                                form[0].reset();
                                window.location= url+'empleado/index';
                            },
                            error: function(){
                                Swal.fire("Hubo un problema");
                            }
                        }) 
                    } 
                    else if (result.isDismissed) { 
                        swal.fire( 
                            'Operación cancelada', '', 
                            'warning' 
                        ) 
                    } 
            }); 
        }
     });
    })
    

    //Modificar productos
    $('#btnModificar').click(function(e){
        e.preventDefault()
        var form = $("#frmProductos")
        var method = form.attr('method')
        var action = form.attr('action')
        var data = form.serialize();

        swal.fire({ 
            icon: 'question', 
            title: '¿Esta seguro de modificar el producto ?',
            showCancelButton: true, 
            confirmButtonText: 'Si, Modificar' 
            }).then(function(result) { 
                    if (result.isConfirmed) { 
                        $.ajax({
                            type : method,
                            url : action,
                            data : data,
                            success: function(response){
                                var mensaje = (response)?'Producto modificado':'Error al modificar el producto';
                                Swal.fire(mensaje);
                                window.location= url+'empleado/index';
                            },
                            error: function(){
                                Swal.fire("Hubo un problema");
                            }
                        })  
                    } 
                    else if (result.isDismissed) { 
                        swal.fire( 
                            'Operación cancelada', '', 
                            'warning' 
                        ) 
                    } 
            }); 


        
    })

    // Eliminar productos
    $('body').on('click','#btnEliminar', function(e){
        e.preventDefault()
        var href = $(this).attr('href');
        swal.fire({ 
            icon: 'question', 
            title: '¿Esta seguro de eliminar ?',
            showCancelButton: true, 
            confirmButtonText: 'Si, Eliminar' 
            }).then(function(result) { 
                    if (result.isConfirmed) { 
                        $.ajax({
                            type : 'GET',
                            url : href,
                            success: function(response){
                                var mensaje = (response)?'Producto eliminado':'Error al eliminar el producto';
                                Swal.fire(mensaje);
                                // Invocar función para listar productos
                                mostrarProductos();
                            }, 
                            error:function(response){
                                Swal.fire("Hubo un problema");
                            }
                        })

                    } 
                    else if (result.isDismissed) { 
                        swal.fire( 
                            'Operación cancelada', '', 
                            'warning' 
                        ) 
                    } 
            }); 
    })
})