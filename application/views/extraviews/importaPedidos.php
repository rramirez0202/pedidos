<p>Al importar pedidos es conveniente considerar que si se encuentra el No. de Pedido o si IdWinApp el pedido será <br />
actualizado, con las partidas cargadas en el archivo de importacion, por lo que si alguna partida esta en el sistema  <br />
y no se envía en la importación está se eliminará del pedido en el sistema.</p>
<p>El caso de que no se localicen las referencias al pedido, se generará un nuevo pedido en caso de cumplir  <br />
con los elementos básicos (No. de cliente o su IdWinApp, Sucursales existentes).</p>
<p>Si en alguna partida no se localiza el IdWinApp del producto, esta será cargada pero no se creará ninguna  <br />referencia interna con el producto en el sistema.</p>
<p>Pulse <a href="<?= base_url("project_files/templates/plantilla_pedido.xlsx?time=".time()); ?>" target="_blanck">aquí</a> para descargar la plantilla de excel con el orden de los elementos de los pedidos a importar.</p>
<p>Pulse <a href="<?= base_url("project_files/templates/esquema_pedido.xsd?time=".time()); ?>" target="_blanck">aquí</a> para descargar el archivo de definicion xml con el orden de los elementos delos pedidos a importar.</p>
<hr />