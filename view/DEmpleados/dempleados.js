
var tabla;

function init()
{
	$("#dempleados_form").on("submit",function(e){
		guardaryeditar(e);
	});
} 


$(document).ready(function(){ 
    tabla=$('#dempleados_data').dataTable({
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
        "ajax":{
            url: '../../controller/DEmpleados.php?op=listar',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);	
            }
        },
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
	    "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
		}
	}).DataTable();
});


function guardaryeditar(e)
{
	// Evitar que se envia varias veces
	e.preventDefault();
	var formData = new FormData($("#dempleados_form")[0]);
	$.ajax({
		url: "../../controller/DEmpleados.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos)
		{
			$("#dempleados_form")[0].reset();
			$("#modalEmpleados").modal('hide');
			$("#dempleados_data").DataTable().ajax.reload();
			swal.fire('Registro !!!','Se registró correctamente.','success')
		}
	});
}

function editar(id)
{
	$('#mdltitulo').html('Editar Registro');
	$.post("../../controller/DEmpleados.php?op=mostrar",{id:id},function(data){
		data = JSON.parse(data);
		console.log(data);
		$('#id').val(data.id);
		$('#nombre').val(data.nombre);
		$('#apellido_paterno').val(data.apellido_paterno);
		$('#apellido_materno').val(data.apellido_materno);
		$('#puesto').val(data.puesto);
		$('#status').val(data.status);
		
		

	})
	$("#modalEmpleados").modal("show");
	

}

function eliminar(id)
{
	swal.fire({
		title: "CRUD",
		text: "¿ Estas seguro de eliminar el registro ?",
		icon: "error",
		showCancelButton: true,		
		confirmButtonText: "Si",
		cancelButtonText: "No",
		reverseButtons: false
	}).then((result) => {
		if (result.isConfirmed) 
		{
			// Envia un post a la pagina de productos
			$.post("../../controller/DEmpleados.php?op=eliminar",{id:id},function(data){
			$('#dempleados_data').DataTable().ajax.reload();	
			});
			// Manda actualizar el datatable|
			
			swal.fire('Eliminado !!!','El registro se eliminó correctamente.','success')
		}
	});
}

$(document).on("click","#btnnuevo", function(){
	$("#mdltitulo").html("Nuevo Registro");
	$("#modalEmpleados").modal("show");
});

init();