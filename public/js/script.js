document.addEventListener('DOMContentLoaded', function() {

    fetch('http://localhost:8000/api/productos')
    .then( response => response.json() )
    .then( json => {
        const data = json.data;

        const tableBody = document.querySelector('#dataTable tbody');
        tableBody.innerHTML = '';

        data.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.id}</td>
                <td>${item.nombre}</td>
                <td id="stock-${item.id}">${item.stock}</td>
                <td id="categoria-${item.id}">${item.categoria.nombre}</td>
                <td>
                    <button class="btn btn-success btn-sm actualizar-stock" data-id="${item.id}" data-nombre="${item.nombre}" data-stock="${item.stock}" data-bs-toggle="modal" data-bs-target="#stockModal">Actualizar</button>
                    <button class="btn btn-danger btn-sm eliminar-producto" data-id="${item.id}">Eliminar</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        document.querySelectorAll('.actualizar-stock').forEach(button => {
            button.addEventListener('click', function () {
                const productoId = this.getAttribute('data-id');
                const productoNombre = this.getAttribute('data-nombre');
                const currentStock = this.getAttribute('data-stock');

                document.getElementById('productoId').value = productoId;
                document.getElementById('productoNombre').value = productoNombre;
                document.getElementById('nuevoStock').value = currentStock;
            });
        });

        document.querySelectorAll('.eliminar-producto').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                eliminarProducto(productId);
            });
        });

    })

    cargarCategorias();
})

document.getElementById('actualizarStock').addEventListener('click', function () {
    const productoId = document.getElementById('productoId').value;
    const nuevoStock = document.getElementById('nuevoStock').value;

    fetch(`http://localhost:8000/api/productos/${productoId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ stock: nuevoStock })
    })
    .then(response => response.json())
    .then(data => {
        
        document.querySelector(`#stock-${productoId}`).textContent = nuevoStock;
        
        // Cerrar el modal
        let modal = bootstrap.Modal.getInstance(document.getElementById('stockModal'));
        modal.hide();
    })
    .catch(error => console.error('Error al actualizar el stock:', error));
});

function eliminarProducto(id) {
    if (confirm("¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.")) {
        fetch(`http://localhost:8000/api/productos/${id}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (response.status === 204) { 
                alert('Producto eliminado correctamente');

                document.querySelector(`button[data-id="${id}"]`).closest('tr').remove();
            } else {
                throw new Error('Error al eliminar el producto');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

document.getElementById('addProductForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombreProducto').value.trim();
    const stock = document.getElementById('stockProducto').value.trim();
    const categoriaProducto = document.getElementById('categoriaProducto').value.trim();

    if (!nombre || stock === '') {
        alert('Por favor, completa todos los campos.');
        return;
    }

    fetch('http://localhost:8000/api/productos', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            nombre: nombre,
            stock: parseInt(stock, 10),
            category_id: categoriaProducto
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw err; 
            });
        }
        return response.json();
    })
    .then(nuevoProductoData => {
        const nuevoProducto = nuevoProductoData.data
        console.log(nuevoProducto)
        alert('Producto agregado correctamente');

        // Agregar la nueva fila a la tabla sin recargar la página
        const tableBody = document.querySelector('#dataTable tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${nuevoProducto.id}</td>
            <td>${nuevoProducto.nombre}</td>
            <td id="stock-${nuevoProducto.id}">${nuevoProducto.stock}</td>
            <td id="categoria-${nuevoProducto.id}">${nuevoProducto.categoria.nombre}</td>
            <td>
                <button class="btn btn-success btn-sm actualizar-stock" 
                    data-id="${nuevoProducto.id}" data-nombre="${nuevoProducto.nombre}" data-stock="${nuevoProducto.stock}"
                    data-bs-toggle="modal" data-bs-target="#stockModal">
                    Actualizar
                </button>
                <button class="btn btn-danger btn-sm eliminar-producto" data-id="${nuevoProducto.id}">
                    Eliminar
                </button>
            </td>
        `;
        tableBody.appendChild(row);

        // Cerrar el modal y limpiar el formulario
        document.getElementById('addProductForm').reset();
        new bootstrap.Modal(document.getElementById('addProductModal')).hide();

        // Volver a agregar eventos a los botones de eliminar
        document.querySelectorAll('.eliminar-producto').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                eliminarProducto(productId);
            });
        });
    })
    .catch(error => alert(error.message));
});

function cargarCategorias() {
    fetch('http://localhost:8000/api/categoria')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener categorías');
            }
            return response.json();
        })
        .then(data => {
            const selectCategoria = document.getElementById('categoriaProducto');
            selectCategoria.innerHTML = '<option value="">Seleccione una categoría</option>'; // Limpiar opciones previas

            data.data.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id;
                option.textContent = categoria.nombre;
                selectCategoria.appendChild(option);
            });
        })
        .catch(error => console.error("Error cargando categorías:", error));
}

document.getElementById('btnGuardarCategoria').addEventListener('click', function () {
    const nombre = document.getElementById('nombreCategoria').value.trim();
    const errorDiv = document.getElementById('errorCategoria');

    if (!nombre) {
        errorDiv.textContent = "El nombre de la categoría es obligatorio.";
        return;
    }

    fetch('http://localhost:8000/api/categoria', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nombre: nombre })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        alert("Categoría creada correctamente.");
        document.getElementById('formNuevaCategoria').reset();
        new bootstrap.Modal(document.getElementById('modalNuevaCategoria')).hide();
        cargarCategorias(); // Recargar el select de categorías
    })
    .catch(error => {
        console.error('Error al crear categoría:', error);
        errorDiv.textContent = error.message || "Error al agregar la categoría.";
    });
});
