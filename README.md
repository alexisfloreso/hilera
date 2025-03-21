# hilera

# Proyecto API REST en Laravel

Este es un proyecto de API REST desarrollado en Laravel que permite la gestión de productos y categorías.

## Requisitos
- PHP 8.x
- Composer
- MySQL

## Instalación
1. Clona el repositorio:
   ```sh
   git clone https://github.com/alexisfloreso/hilera.git
   cd hilera
   ```
2. Instala las dependencias de Laravel:
   ```sh
   composer install
   ```
3. Crea y configura el archivo de entorno:
   ```sh
   cp .env.example .env
   ```
   Luego, edita el archivo `.env` y ajusta las credenciales de la base de datos.


## Uso
### Ejcuta el archivo public/init.sql en un cliente MySQL para crear la base de datos

### Levantar el servidor de desarrollo
```sh
php artisan serve
```
### Abrir el archivo public/index.html en el navegador


La API estará disponible en `http://localhost:8000/api`

### Endpoints principales
#### Productos
- Obtener todos los productos: `GET /api/productos`
- Crear un producto: `POST /api/productos`
- Actualizar un producto: `PUT /api/productos/{id}`
- Eliminar un producto: `DELETE /api/productos/{id}`

#### Categorías
- Obtener todas las categorías: `GET /api/categoria`
- Crear una categoría: `POST /api/categoria`





