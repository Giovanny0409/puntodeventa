<?php
 session_start();
 if (!isset($_SESSION['usuario'])) {
     header("Location: login.html");
     exit();
 }
 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Punto de Venta</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="styles.css">
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
 </head>
 <body>
     <div class="container mt-5">
     <a href="backend/logout.php" class="btn btn-danger float-end mb-3">Cerrar Sesión</a>

         <h2 class="text-center">Punto de Venta</h2>
         <div class="d-flex justify-content-between mb-3">
             <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarProductoModal">Agregar Producto</button>
             <select class="form-select w-25">
                 <option selected>Vender por...</option>
                 <option value="1">Kilo</option>
                 <option value="2">Bulto</option>
                 <option value="3">Producto</option>
             </select>
         </div>
         <div id="productos" class="mb-4">
             </div>

         <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="agregarProductoLabel">Agregar Producto</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <form id="formAgregarProducto">
                             <div class="mb-3">
                                 <label for="nombre_producto" class="form-label">Nombre del Producto:</label>
                                 <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Nombre" required>
                             </div>
                             <div class="mb-3">
                                 <label for="descripcion" class="form-label">Descripción:</label>
                                 <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
                             </div>
                             <div class="mb-3">
                                 <label for="cantidad" class="form-label">Cantidad:</label>
                                 <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" value="1" min="1" required>
                             </div>
                             <div class="mb-3">
                                 <label for="precio" class="form-label">Precio:</label>
                                 <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Precio" required>
                             </div>
                         </form>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-primary" onclick="guardarProducto()">Guardar</button>
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

     <script>
         function cargarProductos() {
             fetch("backend/obtener_productos.php")
                 .then(respuesta => respuesta.text())
                 .then(html => {
                     document.getElementById("productos").innerHTML = html;
                 });
         }

         function guardarProducto() {
             const formData = new FormData(document.getElementById('formAgregarProducto'));

             fetch("backend/obtener_producto.php", {
                 method: 'POST',
                 body: formData
             })
             .then(response => response.text())
             .then(mensaje => {
                 alert(mensaje); // Muestra un mensaje al usuario
                 $('#agregarProductoModal').modal('hide'); // Cierra el modal
                 cargarProductos(); // Recarga la lista de productos
             })
             .catch(error => {
                 console.error('Error:', error);
                 alert('Error al guardar el producto.');
             });
         }

         // Cargar al inicio
         cargarProductos();

         // Actualizar cada 10 segundos
         setInterval(cargarProductos, 10000);
     </script>

 </body>
 </html>