function Alert(mensaje,afterOk) //msgID: 1 Deprecated
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		'<div>'+mensaje+'</div><div style="text-align: center;"><button id="btnOk" class="btn btn-success">Aceptar</button></div>',
		afterBlock:		function(){
							var self=this;
							$('#btnOk').bind('click',function(){
								self.unblock(300);
								afterOk();
							});
		                }
		//, msgID:1
	});
}
function Confirm(mensaje,afterOk) //msgID: 2 Deprecated
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		'<div>'+mensaje+'</div><div style="text-align: center;"><button id="btnOk" class="btn btn-success">Aceptar</button> <button id="btnCancel" class="btn btn-danger">Cancelar</button></div>',
		afterBlock : 	function(){
							var self=this;
							$('#btnOk').bind('click',function(){
								self.unblock(300);
								afterOk();
							});
							$('#btnCancel').bind('click',function(){
								self.unblock(300);
							});
		                }
		//, msgID:2
	});
}
function Mensaje(mensaje) //msgID: 3
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		mensaje,
		msgID:			3
	});
}
function MensajeAfter(mensaje,afterOk) //msgID: 4
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		mensaje,
		afterBlock:		function(){
							var self=this;
							afterOk();
						},
		msgID:			4
	});
}
function MuestraCPFrm(cp,colonia,municipio,estado,fnSelecciona)
{
	var datos="cp="+cp+"&colonia="+colonia+"&municipio="+municipio+"&estado="+estado+"&fnSelecciona="+fnSelecciona;
	Mensaje("Cargando Códigos Postales");
	var ajx=$.ajax({
		method:	"POST",
		url:	baseURL+'generico/creaFrmCP',
		cache:	false,
		data:	datos
	});
	ajx.fail(function(jqXHRObj,mensaje){
		$.msg('unblock',10,3);
		setTimeout(function(){
			Mensaje("Error al cargar formulario: "+mensaje+"<br />"+jqXHRObj.responseText);
		},500);
	});
	ajx.done(function(resp){
		$.msg('unblock',10,3);
		setTimeout(function(){
			MensajeAfter(resp,function(){
				$("#btnCancelarCP").bind('click',function(){
					$.msg('unblock',10,3);
				});
				$("#btnBuscarCP").bind('click',function(){
					var tmpCp			= $("#frm_cp_cp").val().trim();
					var tmpColonia		= $("#frm_cp_colonia").val().trim();
					var tmpMunicipio	= $("#frm_cp_municipio").val().trim();
					var tmpEstado		= $("#frm_cp_estado").val().trim();
					$.msg('unblock',10,4);
					setTimeout(function(){
						MuestraCPFrm(tmpCp,tmpColonia,tmpMunicipio,tmpEstado,fnSelecciona);
					},500);
				});
			});
		},500);
	});
}
function fnValidaciones()
{
	this.Vacio=function(idCampo,mensaje)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		if(valor.length==0) 
		{
			Alert(mensaje,function(){$("#"+idCampo).focus();});
			return true;
		}
		return false;
	}
	this.Numerico=function(idCampo,mensaje)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		if(this.Vacio(idCampo,mensaje))
			return false;
		if(isNaN(valor))
		{
			Alert(mensaje,function(){$("#"+idCampo).focus();});
			return false;
		}
		return true;
	}
	this.NPositivo=function(idCampo,mensaje,IncluyeCero)
	{
		if(this.Numerico(idCampo,mensaje))
		{
			var valor	= "";
			valor		= parseInt($("#"+idCampo).val().trim());
			if(IncluyeCero)
			{
				if(valor>=0) return true;
				else Alert(mensaje,function(){$("#"+idCampo).focus();});
			}
			else
				if(valor>0) return true;
				else Alert(mensaje,function(){$("#"+idCampo).focus();});
		}
		return false;
	}
	this.LargoEntre=function(idCampo,mensaje,minimo,maximo,puedeSerVacio)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		if(!puedeSerVacio && this.Vacio(idCampo,mensaje))
			return false;
		if(puedeSerVacio && valor.length==0)
			return true;
		if(valor.length<minimo||valor.length>maximo)
		{
			Alert(mensaje,function(){$("#"+idCampo).focus();});
			return false;
		}
		return true;
	}
	this.LargoCampo=function(idCampo)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		return valor.length;
	}
	this.Valor=function(idCampo)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		return valor;
	}
	this.CreaDireccion=function(idCampoCalle, idCampoNumExterior, idCampoNumInterior, idCampoColonia,idCampoDelegacion,idCampoEstado)
	{
		var calle		= this.Valor(idCampoCalle);
		var numExterior	= this.Valor(idCampoNumExterior);
		var numInterior	= this.Valor(idCampoNumInterior);
		var colonia		= this.Valor(idCampoColonia);
		var delegacion	= idCampoDelegacion!=""?this.Valor(idCampoDelegacion):"";
		var estado		= idCampoEstado!=""?this.Valor(idCampoEstado):"";
		var direccion	= "";
		direccion += calle + " ";
		direccion += numExterior;
		if(numInterior!="")
			direccion += " (Int. " + numInterior + "), ";
		else
			direccion += ", ";
		direccion += colonia;
		if(delegacion!="")
			direcion += ", "+delegacion;
		if(estado!="")
			direccion += ", "+estado
		return direccion;
	}
}

var auxiliarFnPermiso=null;
function fnPermiso()
{
	this.CapturarNuevosElementos=function()
	{
		auxiliarFnPermiso=new Array();
		$('#elementosMenu input').each(function(idx){
			if(this.checked)
			{ 
				auxiliarFnPermiso.push(this.value);
				this.checked=false;
			}
		});
		if(auxiliarFnPermiso.length>0)
			this.MuestraFrmElementos(auxiliarFnPermiso.shift());
		else
			Alert("Debe seleccionar un elemento para anidar los permisos",function(){return true;});
	}
	this.MuestraFrmElementos=function(idPermiso)
	{
		var ajx=$.ajax({
			method:	'POST',
			url:	baseURL+"permisos/elementosfrm/"+idPermiso,
			cache:	false
		});
		ajx.done(function(resp){
			Confirm(resp,function(){
				Permiso.SalvarElementos();
			});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			setTimeout(function(){
				Mensaje("Error al cargar formulario de entrada de datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500)
		});
	}
	this.SalvarElementos=function()
	{
		var ajx=$.ajax({
			method:	'POST',
			url:	baseURL+"permisos/salvarelementos/"+$("#idpermiso").val(),
			cache:	false,
			data:	{
				elemento1:$("#elemento1").val(),
				elemento2:$("#elemento2").val(),
				elemento3:$("#elemento3").val(),
				elemento4:$("#elemento4").val(),
				elemento5:$("#elemento5").val(),
				descripcion1:$("#descripcion1").val(),
				descripcion2:$("#descripcion2").val(),
				descripcion3:$("#descripcion3").val(),
				descripcion4:$("#descripcion4").val(),
				descripcion5:$("#descripcion5").val()
			}
		});
		ajx.done(function(resp){
			if(auxiliarFnPermiso.length>0)
				setTimeout(function(){
					Permiso.MuestraFrmElementos(auxiliarFnPermiso.shift());
				},500);
			else
				location.reload();
		});
		ajx.fail(function(jqXHRObj,mensaje){
			setTimeout(function(){
				Mensaje("Error al almacenar datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500)
		});
	}
	this.ActualizarElementos=function()
	{
		auxiliarFnPermiso=new Array();
		$('#elementosMenu input').each(function(idx){
			if(this.checked)
			{ 
				auxiliarFnPermiso.push(this.value);
				this.checked=false;
			}
		});
		if(auxiliarFnPermiso.length>0)
			this.MuestraFrmUpdElemento(auxiliarFnPermiso.shift());
		else
			Alert("Debe seleccionar un elemento para actualizar",function(){return true;});
	}
	this.MuestraFrmUpdElemento=function(idPermiso)
	{
		var ajx=$.ajax({
			method:	'POST',
			url:	baseURL+"permisos/elementosfrmupd/"+idPermiso,
			cache:	false
		});
		ajx.done(function(resp){
			Confirm(resp,function(){
				Permiso.SalvarElementoUpd();
			});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			setTimeout(function(){
				Mensaje("Error al cargar formulario de entrada de datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500)
		});
	}
	this.SalvarElementoUpd=function()
	{
		var ajx=$.ajax({
			method:	'POST',
			url:	baseURL+"permisos/salvarelementosupd/"+$("#idpermiso").val(),
			cache:	false,
			data:	{
				elemento:$("#elemento").val(),
				descripcion:$("#descripcion").val()
			}
		});
		ajx.done(function(resp){
			if(auxiliarFnPermiso.length>0)
				setTimeout(function(){
					Permiso.MuestraFrmUpdElemento(auxiliarFnPermiso.shift());
				},500);
			else
				location.reload();
		});
		ajx.fail(function(jqXHRObj,mensaje){
			setTimeout(function(){
				Mensaje("Error al almacenar datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500)
		});
	}
	this.EliminarConfirm=function()
	{
		auxiliarFnPermiso=new Array();
		$('#elementosMenu input').each(function(idx){
			if(this.checked)
			{ 
				auxiliarFnPermiso.push(this.value);
				this.checked=false;
			}
		});
		if(auxiliarFnPermiso.length>0)
			Confirm("¿Realmente desea eliminar los permisos seleccionados? Al hacerlo, los permisos hijo tambien serán eliminados.",function(){
				Permiso.Eliminar();
			});
		else
			Alert("Debe seleccionar un permiso para eliminar",function(){return true;});
	}
	this.Eliminar=function()
	{
		if(auxiliarFnPermiso.length>0)
		{
			var ajx=$.ajax({
				method:	'POST',
				url:	baseURL+"permisos/eliminar",
				cache:	false,
				data:	{permisos:auxiliarFnPermiso.join(",")}
			});
			ajx.done(function(resp){
				location.reload();
			});
			ajx.fail(function(jqXHRObj,mensaje){
				setTimeout(function(){
					Mensaje("Error al eliminar datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
}

function fnPerfil()
{
	this.ValidaFrmIn=function()
	{
		if(Validacion.Vacio('frm_perfil_nombre','Debe ingresar un nombre para el perfil.'))
			return false;
		return true
	}
	this.Enviar=function(nuevo)
	{
		if(this.ValidaFrmIn())
		{
			var urlFrm=baseURL+"perfiles/"+(nuevo===true?'add':'update');
			Mensaje("Guardando");
			var ajx=$.ajax({
				method:	"POST",
				url:	urlFrm,
				cache:	false,
				data:	$("#frm_perfiles").serialize()
			});
			ajx.done(function(resp){
				if(resp!="" && !isNaN(parseInt(resp)))
					location.href=baseURL+"perfiles/ver/"+resp;
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.Eliminar=function(id)
	{
		Confirm("¿Realmente desea eliminar este Perfil?",function(){
			$.msg('unblock',10,2);
			setTimeout(function(){
				Mensaje("Eliminando");
				var ajx=$.ajax({
					method:	"POST",
					url:	baseURL+'perfiles/eliminar/'+id,
					cache:	false
				});
				ajx.done(function(resp){
					if(resp=="")
						location.href=baseURL+'perfiles';
					else
						setTimeout(function(){
						Mensaje(resp);
					},500);
				});
				ajx.fail(function(jqXHRObj,mensaje){
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje("Error al eliminar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500);
				});
			},500);
		});
	}
}

function fnUsuario()
{
	this.ValidaFrmIn=function()
	{
		if(Validacion.Vacio('frm_usuario_nombre','Debe ingresar el nombre del usuario.'))
			return false;
		if(Validacion.Vacio('frm_usuario_usuario','Debe ingresar el usuario.'))
			return false;
		if(Validacion.Vacio('frm_usuario_email','Debre ingresar el correo electrónico del usuario'))
			return false;
		return true;
	}
	this.Enviar=function(nuevo)
	{
		if(this.ValidaFrmIn())
		{
			var urlFrm=baseURL+"usuarios/"+(nuevo===true?'add':'update')+(typeof IDCLIENTE !="undefined" && IDCLIENTE>0?"/"+IDCLIENTE:"");
			Mensaje("Guardando");
			var ajx=$.ajax({
				method:	"POST",
				url:	urlFrm,
				cache:	false,
				data:	$("#frm_usuarios").serialize()
			});
			ajx.done(function(resp){
				if(resp!="" && !isNaN(parseInt(resp)) && resp.length<=10)
					location.href=baseURL+"usuarios/ver/"+resp+(typeof IDCLIENTE !="undefined" && IDCLIENTE>0?"/"+IDCLIENTE:"");
				else
					Mensaje(resp);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.Eliminar=function(id)
	{
		var urlReturn=baseURL+'usuarios/index';
		if(typeof IDCLIENTE !="undefined" && IDCLIENTE>0)
			urlReturn=baseURL+"clientes/ver/"+IDCLIENTE;
		Confirm("¿Realmente desa eliminar este Usuario?",function(){
			$.msg('unblock',10,2);
			setTimeout(function(){
				Mensaje("Eliminando");
				var ajx=$.ajax({
					method:	"POST",
					url:	baseURL+'usuarios/eliminar/'+id,
					cache:	false
				});
				ajx.done(function(resp){
					if(resp=="")
						location.href=urlReturn;
					else
						Mensaje(resp);
				});
				ajx.fail(function(jqXHRObj,mensaje){
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje("Error al eliminar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500);
				});
			},500);
		});
	}
	this.GetAcceso=function()
	{
		var dataVars={
			usr:$("#usr").val(),
			pwd:$("#pwd").val()
		};
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+'sesiones/login',
			data:	dataVars,
			cache:	false
		});
		ajx.done(function(resp){
			if(resp.trim()=="")
				location.href=baseURL+'inicio/principal';
			else
				Alert(resp,function(){return true});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Alert("Error al accesar: "+mensaje+"<br />"+jqXHRObj.responseText,function(){return true;});
			},500);
		});
	}
	this.GetData=function()
	{
		var dataVars={
			usr:$("#usr").val()
		};
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+'sesiones/obtenercontrasena',
			data:	dataVars,
			cache:	false
		});
		ajx.done(function(resp){
			Alert(resp,function(){return true});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Alert("Error al accesar: "+mensaje+"<br />"+jqXHRObj.responseText,function(){return true;});
			},500);
		});
	}
	this.ResetearPwr=function()
	{
		if(Validacion.Vacio('frm_data_usr','Debe ingresar el usuario')) 
			return false;
		var dataVars={
			usr:$("#frm_data_usr").val()
		};
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+'reseteopassword/resetear',
			data:	dataVars,
			cache:	false
		});
		ajx.done(function(resp){
			Alert(resp,function(){return true});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Alert("Error al establecer contraseña: "+mensaje+"<br />"+jqXHRObj.responseText,function(){return true;});
			},500);
		});
	}
	this.CambiarPwd=function()
	{
		if(Validacion.Vacio('frm_data_actual','Debe ingresar su contraseña de acceso al sistema actual.'))
			return false;
		if(Validacion.Vacio('frm_data_nueva','Debe ingresar su nueva contraseña para accesar al sistema.'))
			return false;
		if(Validacion.Vacio('frm_data_confirmacion','Debe ingresar la confirmación de la nueva contraseña para accesar al sistema'))
			return false;
		var dataVars={
			actual	: $("#frm_data_actual").val(),
			nueva	: $("#frm_data_nueva").val(),
			confirm	: $("#frm_data_confirmacion").val()
		};
		if(dataVars.nueva!=dataVars.confirm)
		{
			Alert("La contraseña nueva y la confirmación deben ser iguales",function(){
				$("#frm_data_confirmacion").focus();
			});
		}
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+'cambiopassword/cambiar',
			data:	dataVars,
			cache:	false
		});
		ajx.done(function(resp){
			Alert(resp,function(){return true});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Alert("Error al establecer contraseña: "+mensaje+"<br />"+jqXHRObj.responseText,function(){return true;});
			},500);
		});
	}
}

function fnProducto()
{
	this.ValidaFrmIn=function()
	{
		if(Validacion.Vacio('frm_producto_nombre','Debe ingresar el nombre del producto'))
			return false;
		if(!Validacion.NPositivo('frm_producto_precio','Debe ingresar el precio del producto, y debe ser mayor o igual que 0.00',true))
			return false;
		return true;
	}
	this.CargarDatos=function(nuevo)
	{
		if(this.ValidaFrmIn())
		{
			var urlFrm=baseURL+"productos/"+(nuevo===true?'add':'update');
			var ajx=$.ajax({
				method:	"POST",
				url:	urlFrm,
				cache:	false,
				data:	$('#frm_productos').serialize()
			});
			ajx.done(function(resp){
				if(resp!="" && !isNaN(parseInt(resp)))
					location.href=baseURL+"productos/ver/"+resp;
				else
					$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje(resp);
				},500)
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.Enviar=function(nuevo)
	{
		if(this.ValidaFrmIn())
		{
			Mensaje("Cargando datos del producto");
			if($("#frm_producto_imagen_file")[0].files[0])
			{
				var frmData=new FormData();
				frmData.append("imagen",$("#frm_producto_imagen_file")[0].files[0]);
				var ajx=$.ajax({
					method:	"POST",
					url:	baseURL+"productos/cargaimagen",
					cache:	false,
					data:	frmData,
					processData: false, 
					contentType: false
				});
				ajx.done(function(resp){
					resp=resp.trim();
					if(resp!="")
					{
						$("#frm_producto_imagen").attr('value',resp);
						Producto.CargarDatos(nuevo);
					}
				});
				ajx.fail(function(jqXHRObj,mensaje){
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500)
				});
			}
			else
			{
				Producto.CargarDatos(nuevo);
			}
		}
	}
	this.Eliminar=function(id)
	{
		Confirm("¿Realmente desea eliminar este producto?",function(){
			$.msg('unblock',10,2);
			setTimeout(function(){
				Mensaje("Eliminando");
				var ajx=$.ajax({
					method:	"POST",
					url:	baseURL+"productos/eliminar/"+id,
					cache:	false
				});
				ajx.done(function(resp){
					if(resp=="")
						location.href=baseURL+"productos";
					else
						Mensaje(resp);
				});
				ajx.fail(function(jqXHRObj,mensaje){
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje("Error al eliminar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500);
				});
			},500);
		});
	}
	this.FrmImportar=function(tipo)
	{
		var fn=null;
		if(tipo.trim().toUpperCase()=="XML")
			fn=Producto.ImportarXML;
		else if(tipo.trim().toUpperCase()=="EXCEL")
			fn=Producto.ImportarExcel;
		if(fn!=null)
		{
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"generico/creaFrmGetFile/importaProductos",
				cache:	false
			});
			ajx.done(function(resp){
				resp=resp.trim();
				if(resp!="")
				{
					Confirm(resp,function(){
						fn();
					});
				}
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al obtener formulario para cargar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.ImportarXML=function()
	{
		if($("#frm_archivo")[0].files[0])
		{
			setTimeout(function(){
				Mensaje("Cargando Datos");
			},1000);
			$("#frm_file")[0].disabled="true";
			var frmData=new FormData();
			frmData.append("archivo",$("#frm_archivo")[0].files[0]);
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"productos/cargaXML",
				cache:	false,
				data:	frmData,
				processData: false, 
				contentType: false
			});
			ajx.done(function(resp){
				if(resp.trim()=="")
					location.reload();
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.ImportarExcel=function()
	{
		if($("#frm_archivo")[0].files[0])
		{
			setTimeout(function(){
				Mensaje("Cargando Datos");
			},1000);
			$("#frm_file")[0].disabled="true";
			var frmData=new FormData();
			frmData.append("archivo",$("#frm_archivo")[0].files[0]);
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"productos/cargaExcel",
				cache:	false,
				data:	frmData,
				processData: false, 
				contentType: false
			});
			ajx.done(function(resp){
				if(resp.trim()=="")
					location.reload();
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
}

function fnCliente()
{
	this.ValidaFrmIn=function()
	{
		if(Validacion.Vacio('frm_cliente_nombre','Debe ingresar el nombre del cliente.'))
			return false;
		if(Validacion.Vacio('frm_cliente_razonsocial','Debe ingresar la razon social del cliente.'))
			return false;
		if(Validacion.Vacio('frm_cliente_rfc','Debe ingresar el RFC del cliente.'))
			return false;
		return true;
	}
	this.Enviar=function(nuevo)
	{
		if(this.ValidaFrmIn())
		{
			var urlFrm=baseURL+"clientes/"+(nuevo===true?'add':'update');
			Mensaje("Guardando");
			var ajx=$.ajax({
				method:	"POST",
				url:	urlFrm,
				cache:	false,
				data:	$("#frm_clientes").serialize()
			});
			ajx.done(function(resp){
				if(resp!="" && !isNaN(parseInt(resp)))
					location.href=baseURL+"clientes/ver/"+resp;
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.Eliminar=function(id)
	{
		Confirm("¿Realmente desea eliminar este cliente?",function(){
			$.msg('unblock',10,2);
			setTimeout(function(){
				Mensaje("Eliminando");
				var ajx=$.ajax({
					method:	"POST",
					url:	baseURL+'clientes/eliminar/'+id,
					cache:	false
				});
				ajx.done(function(resp){
					if(resp=="")
						location.href=baseURL+'clientes';
					else
						setTimeout(function(){
						Mensaje(resp);
					},500);
				});
				ajx.fail(function(jqXHRObj,mensaje){
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje("Error al eliminar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500);
				});
			},500);
		});
	}
	this.FrmImportar=function(tipo)
	{
		
		var fn=null;
		if(tipo.trim().toUpperCase()=="XML")
			fn=Cliente.ImportarXML;
		else if(tipo.trim().toUpperCase()=="EXCEL")
			fn=Cliente.ImportarExcel;
		if(fn!=null)
		{
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"generico/creaFrmGetFile/importaClientes",
				cache:	false
			});
			ajx.done(function(resp){
				resp=resp.trim();
				if(resp!="")
				{
					Confirm(resp,function(){
						fn();
					});
				}
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al obtener formulario para cargar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.ImportarXML=function()
	{
		if($("#frm_archivo")[0].files[0])
		{
			setTimeout(function(){
				Mensaje("Cargando Datos");
			},1000);
			$("#frm_file")[0].disabled="true";
			var frmData=new FormData();
			frmData.append("archivo",$("#frm_archivo")[0].files[0]);
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"clientes/cargaXML",
				cache:	false,
				data:	frmData,
				processData: false, 
				contentType: false
			});
			ajx.done(function(resp){
				if(resp.trim()=="")
					location.reload();
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.ImportarExcel=function()
	{
		if($("#frm_archivo")[0].files[0])
		{
			setTimeout(function(){
				Mensaje("Cargando Datos");
			},1000);
			$("#frm_file")[0].disabled="true";
			var frmData=new FormData();
			frmData.append("archivo",$("#frm_archivo")[0].files[0]);
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"clientes/cargaExcel",
				cache:	false,
				data:	frmData,
				processData: false, 
				contentType: false
			});
			ajx.done(function(resp){
				if(resp.trim()=="")
					location.reload();
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
}

function fnSucursal()
{
	this.ValidaFrmIn=function()
	{
		if(Validacion.Vacio('frm_sucursal_nombre','Debe ingresar un nombre para la sucursal'))
			return false;
		return true
	}
	this.Enviar=function(nuevo)
	{
		if(this.ValidaFrmIn())
		{
			var urlFrm=baseURL+"sucursales/"+(nuevo===true?'add':'update');
			Mensaje("Guardando");
			var ajx=$.ajax({
				method:	"POST",
				url:	urlFrm,
				cache:	false,
				data:	$("#frm_sucursales").serialize()
			});
			ajx.done(function(resp){
				if(resp!="" && !isNaN(parseInt(resp)))
					location.href=baseURL+"sucursales/ver/"+resp;
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.Eliminar=function(id,idcliente)
	{
		Confirm("¿Realmente desea eliminar esta Sucursal?",function(){
			$.msg('unblock',10,2);
			setTimeout(function(){
				Mensaje("Eliminando");
				var ajx=$.ajax({
					method:	"POST",
					url:	baseURL+'sucursales/eliminar/'+id,
					cache:	false
				});
				ajx.done(function(resp){
					if(resp=="")
						location.href=baseURL+'clientes/ver/'+idcliente;
					else
						setTimeout(function(){
						Mensaje(resp);
					},500);
				});
				ajx.fail(function(jqXHRObj,mensaje){
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje("Error al eliminar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500);
				});
			},500);
		});
	}
	this.DisplayFrmCP=function()
	{
		MuestraCPFrm($("#frm_sucursal_cp").val().trim(),"","","","Sucursal.EstableceCP")
	}
	this.EstableceCP=function(cp,colonia,municipio,estado)
	{
		$.msg('unblock',10,4);
		$("#frm_sucursal_cp"		).attr('value',	cp);
		$("#frm_sucursal_colonia"	).attr('value',	colonia);
		$("#frm_sucursal_municipio"	).attr('value',	municipio);
		$("#frm_sucursal_estado"	).attr('value',	estado);
	}
}

function fnCatalogos()
{
	this.MuestraFrmNuevo=function()
	{
		var ajx=$.ajax({
			method:	'POST',
			url:	baseURL+"catalogos/catalogofrm",
			cache:	false
		});
		ajx.done(function(resp){
			Confirm(resp,function(){
				location.href=baseURL+"catalogos/nuevo/"+$('#catalogo_name').val();
			});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			setTimeout(function(){
				Mensaje("Error al cargar formulario de entrada de datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500)
		});
	}
	this.MuestraFrmOpcs=function()
	{
		var ajx=$.ajax({
			method:	'POST',
			url:	baseURL+"catalogos/opcionesfrm/"+$("#idcatalogo").val(),
			cache:	false
		});
		ajx.done(function(resp){
			Confirm(resp,function(){
				$("#opcionescatalogo").submit();
			});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			setTimeout(function(){
				Mensaje("Error al cargar formulario de entrada de datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500)
		});
	}
	this.MuestraFrmUpd=function()
	{
		var ajx=$.ajax({
			method:	'POST',
			url:	baseURL+"catalogos/catalogofrm/"+$("#idcatalogo").val(),
			cache:	false
		});
		ajx.done(function(resp){
			Confirm(resp,function(){
				location.href=baseURL+"catalogos/actualiza/"+$("#idcatalogo").val()+"/"+$('#catalogo_name').val();
			});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			setTimeout(function(){
				Mensaje("Error al cargar formulario de entrada de datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500)
		});
	}
	this.BorrarOpciones=function()
	{
		Confirm(
			"¿Realmente desea eliminar las opciones del catalogo seleccionadas?",
			function(){
				var arrOpcs=new Array();
				$('#tablaOpciones input').each(function(idx){
					if(this.checked) 
						arrOpcs.push(this.value);
				});
				var ajx=$.ajax({
					method:	'POST',
					url:	baseURL+"catalogos/borraropciones/"+$("#idcatalogo").val(),
					cache:	false,
					data:	{opciones:arrOpcs.join(',')}
				});
				ajx.done(function(resp){
					location.href=baseURL+"catalogos/ver/"+$("#idcatalogo").val()+"/"+$('#catalogo_name').val();
				});
				ajx.fail(function(jqXHRObj,mensaje){
					setTimeout(function(){
						Mensaje("Error al ejecutar borrado de opciones: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500)
				});
			}
		);
	}
}

function fnPedido()
{
	this.AjustaSucursal=function(idObj,idcte)
	{
		var dir=$('#'+idObj)[0];
		dir.options.length=0;
		if(typeof clientesSucursales != "undefined" && typeof clientesSucursales[idcte])
		{
			var sucs=clientesSucursales[idcte];
			if(sucs.length==0)
			{
				Alert("El cliente seleccionado no tiene sucursales, debe actualizarlo antes de efectuar pedidos.",function(){return true;});
				return false;
			}
			for(var x=0; x<sucs.length;x++)
			{
				dir.options[dir.options.length]=$('<option value="'+sucs[x].idsucursal+'">'+sucs[x].display+'</option>')[0];
			}
			return true;
		}
		return false;
	}
	this.AjustaSucursales=function(idcte)
	{
		$('#frm_pedido_sucursaldireccion')[0].options.length=0;
		$('#frm_pedido_sucursalentrega')[0].options.length=0;
		$('#frm_pedido_sucursalpago')[0].options.length=0;
		return this.AjustaSucursal('frm_pedido_sucursaldireccion',idcte) &&
			this.AjustaSucursal('frm_pedido_sucursalentrega',idcte) &&
			this.AjustaSucursal('frm_pedido_sucursalpago',idcte);
	}
	this.ValidaFrmIn=function()
	{
		if(Validacion.Vacio('frm_pedido_idcliente','Debe seleccionar un cliente válido.'))
			return false;
		if(Validacion.Vacio('frm_pedido_sucursaldireccion','Debe seleccionar una sucursal para facturar el pedido.'))
			return false;
		if(Validacion.Vacio('frm_pedido_sucursalentrega','Debe seleccionar un sucursal para entregar el pedido.'))
			return false;
		if(Validacion.Vacio('frm_pedido_sucursalpago','Debe seleccionar una sucursal para ejecutar el pago del pedido.'))
			return false;
		return true;
	}
	this.Enviar=function(nuevo)
	{
		if(this.ValidaFrmIn())
		{
			var urlFrm=baseURL+"pedidos/"+(nuevo===true?'add':'update');
			Mensaje("Guardando");
			var ajx=$.ajax({
				method:	"POST",
				url:	urlFrm,
				cache:	false,
				data:	$("#frm_pedidos").serialize()
			});
			ajx.done(function(resp){
				if(resp!="" && !isNaN(parseInt(resp)))
					location.href=baseURL+"pedidos/ver/"+resp;
				else
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500);
			});
		}
	}
	this.verCliente=function(id)
	{
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+"clientes/ver2/"+id,
			cache:	false
		});
		ajx.done(function(resp){
			Alert(resp,function(){return true;});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Mensaje("Error al obtener los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500);
		});
	}
	this.verSucursal=function(id)
	{
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+"sucursales/ver2/"+id,
			cache:	false
		});
		ajx.done(function(resp){
			Alert(resp,function(){return true;});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Mensaje("Error al obtener los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500);
		});
	}
	this.cambiaEstado=function(idPedido,idAccion)
	{
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+"pedidos/cambiaEstado",
			cache:	false,
			data:	{
						idpedido:	idPedido,
						idaccion:	idAccion
					}
		});
		ajx.done(function(resp){
			var resp=JSON.parse(resp);
			Alert("El pedido se a actualizado a "+resp.nombre,function(){location.reload();});
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Mensaje("Error al obtener los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500);
		});
	}
	this.cambiaEstadoPartida=function(idPartida,idAccion)
	{
		Mensaje("Actualizando");
		var ajx=$.ajax({
			method:	"POST",
			url:	baseURL+"pedidos/cambiaEstadoPartida",
			cache:	false,
			data:	{
						idpartida:	idPartida,
						idaccion:	idAccion
					}
		});
		ajx.done(function(resp){
			var resp=JSON.parse(resp);
			$("#accionesPartida"+idPartida).html("");
			if(resp.acciones===false||resp.acciones.length==0)
			{
				$($("#accionesPartida"+idPartida)[0].parentNode).hide();
			}
			else
			{
				for(var idx in resp.acciones)
					if(!isNaN(idx))
					{
						var opcion=$('<li onclick="Pedido.cambiaEstadoPartida('+idPartida+','+resp.acciones[idx].idaccion+')"><a href="#">'+resp.acciones[idx].nombre+'</a></li>');
						$("#accionesPartida"+idPartida).append(opcion);
					}
			}
			$("#statusPartida"+idPartida).html(resp.estado.nombre);
			$.msg('unblock',10,3);
		});
		ajx.fail(function(jqXHRObj,mensaje){
			$.msg('unblock',10,3);
			setTimeout(function(){
				Mensaje("Error al obtener los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			},500);
		});
	}
	this.Eliminar=function(id)
	{
		Confirm("¿Realmente desea eliminar este Pedido?",function(){
			$.msg('unblock',10,2);
			setTimeout(function(){
				Mensaje("Eliminando");
				var ajx=$.ajax({
					method:	"POST",
					url:	baseURL+'pedidos/eliminar/'+id,
					cache:	false
				});
				ajx.done(function(resp){
					if(resp=="")
						location.href=baseURL+'pedidos';
					else
						setTimeout(function(){
						Mensaje(resp);
					},500);
				});
				ajx.fail(function(jqXHRObj,mensaje){
					$.msg('unblock',10,3);
					setTimeout(function(){
						Mensaje("Error al eliminar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
					},500);
				});
			},500);
		});
	}
	this.AgregaPartida=function(idPedido,idProducto)
	{
		if(typeof ProductMaster != "undefined" && typeof ProductMaster[idProducto] != "undefined")
		{
			Mensaje("Actualizando pedido");
			var ajx=$.ajax({
				method:	"POST",
				url:		baseURL+"pedidos/agregarpartida",
				cache:		false,
				data:		{
								idpedido:	idPedido,
								idproducto:	idProducto
							}
			});
			ajx.done(function(resp){
				 Pedido.ActualizaPartida(idPedido,idProducto,resp);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al procesar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500);
			})
		}
	}
	this.EliminaPartida=function(idPedido,idProducto)
	{
		if(typeof ProductMaster != "undefined" && typeof ProductMaster[idProducto] != "undefined" && parseInt($("#cantidad"+idProducto).html())>0)
		{
			Mensaje("Actualizando pedido");
			var ajx=$.ajax({
				method:	"POST",
				url:		baseURL+"pedidos/eliminarpartida",
				cache:		false,
				data:		{
								idpedido:	idPedido,
								idproducto:	idProducto
							}
			});
			ajx.done(function(resp){
				 Pedido.ActualizaPartida(idPedido,idProducto,resp);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al procesar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500);
			})
		 }
	}
	this.ActualizaPartida=function(idPedido,idProducto,resp)
	{
		$.msg('unblock',10,3);
		setTimeout(function(){
			try
			{
				resp=JSON.parse(resp);
				$("#totalPartidas").html(resp.totalpartidas);
				$("#totalCosto").html(resp.total);
				Pedido.ActualizaPartidaCantidad(idProducto,resp.cantidad);
			}
			catch(err)
			{
				Alert(resp,function(){return true;});
			}
		},500);
	}
	this.ActualizaPartidaCantidad=function(idProducto,cantidad)
	{
		$("#cantidad"+idProducto).html(cantidad);
	}
	this.Buscar=function(texto)
	{
		texto=$("#txtBusqueda").val().trim().toUpperCase();
		if(typeof ProductMaster != "undefined")
			for(var idx in ProductMaster)
			{
				var prod=ProductMaster[idx];
				if(typeof prod == "object" && typeof prod.idproducto != "undefined" && prod.activo=="1")
				{
					var cad=prod.nombre+" ";
					cad+=prod.descripcion+" ";
					cad+=prod.observaciones+" ";
					cad+=prod.precio;
					cad=cad.toUpperCase();
					if(cad.indexOf(texto)>=0 || texto=="")
						$("#panelProd"+prod.idproducto).show();
					else
						$("#panelProd"+prod.idproducto).hide();
				}
			}
	}
	this.Exportar=function(excel)
	{
		var ajx=$.ajax({
			method: "POST",
			url:	baseURL+"pedidos/frmExport",
			cache:	false,
		});
		ajx.done(function(resp){
			Alert(resp,excel?Pedido.ExportarExcel:Pedido.ExportaXML);
		})
		ajx.fail(function(jqXHRObj,mensaje){
			Mensaje("Error al procesar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
			});
	}
	this.getDataExport=function()
	{
		return {
			inicio	: $("#fechainicio").val(),
			fin		: $("#fechafin").val(),
			estado	: $("#estado").val()
			};
	}
	this.ExportarExcel=function()
	{
		var vars=Pedido.getDataExport();
		window.open(baseURL+"pedidos/exportarExcel/"+vars.inicio+"/"+vars.fin+"/"+vars.estado);
	}
	this.ExportaXML=function()
	{
		var vars=Pedido.getDataExport();
		window.open(baseURL+"pedidos/exportarXML/"+vars.inicio+"/"+vars.fin+"/"+vars.estado);
	}
	this.FrmImportar=function(tipo)
	{
		var fn=null;
		if(tipo.trim().toUpperCase()=="XML")
			fn=Pedido.ImportarXML;
		else if(tipo.trim().toUpperCase()=="EXCEL")
			fn=Pedido.ImportarExcel;
		if(fn!=null)
		{
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"generico/creaFrmGetFile/importaPedidos",
				cache:	false
			});
			ajx.done(function(resp){
				resp=resp.trim();
				if(resp!="")
				{
					Confirm(resp,function(){
						fn();
					});
				}
			});
			ajx.fail(function(jqXHRObj,mensaje){
				$.msg('unblock',10,3);
				setTimeout(function(){
					Mensaje("Error al obtener formulario para cargar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.ImportarXML=function()
	{
		if($("#frm_archivo")[0].files[0])
		{
			setTimeout(function(){
				Mensaje("Cargando Datos");
			},1000);
			$("#frm_file")[0].disabled="true";
			var frmData=new FormData();
			frmData.append("archivo",$("#frm_archivo")[0].files[0]);
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"pedidos/cargaXML",
				cache:	false,
				data:	frmData,
				processData: false, 
				contentType: false
			});
			ajx.done(function(resp){
				if(resp.trim()=="")
					location.reload();
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
	this.ImportarExcel=function()
	{
		if($("#frm_archivo")[0].files[0])
		{
			setTimeout(function(){
				Mensaje("Cargando Datos");
			},1000);
			$("#frm_file")[0].disabled="true";
			var frmData=new FormData();
			frmData.append("archivo",$("#frm_archivo")[0].files[0]);
			var ajx=$.ajax({
				method:	"POST",
				url:	baseURL+"pedidos/cargaExcel",
				cache:	false,
				data:	frmData,
				processData: false, 
				contentType: false
			});
			ajx.done(function(resp){
				if(resp.trim()=="")
					location.reload();
				else
					setTimeout(function(){
						Mensaje(resp);
					},500);
			});
			ajx.fail(function(jqXHRObj,mensaje){
				setTimeout(function(){
					Mensaje("Error al guardar los datos: "+mensaje+"<br />"+jqXHRObj.responseText);
				},500)
			});
		}
	}
}

var Validacion	= new fnValidaciones();
var Permiso		= new fnPermiso();
var Perfil		= new fnPerfil();
var Usuario		= new fnUsuario();
var Producto	= new fnProducto();
var Cliente		= new fnCliente();
var Sucursal	= new fnSucursal();
var Catalogos	= new fnCatalogos();
var Pedido		= new fnPedido();