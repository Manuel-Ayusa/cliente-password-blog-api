# Blogflow - Blog web con gestión de Usuarios, Roles y CRUD
Este repositorio contiene el código de una aplicación web que interactúa con la API RESTful <a href="https://github.com/Manuel-Ayusa/blog-api"><b>Blog API</b></a>. La aplicación permite a los usuarios realizar operaciones CRUD sobre las publicaciones del blog y gestiona diferentes roles de usuario (Admin, Blogger, visitante) con permisos específicos. Ademas el sitio interactúa con la API para obtener los datos de los posts y presentarlos en una interfaz de usuario amigable.

## Descripción
La aplicación está diseñada para proporcionar una interfaz de usuario para interactuar con el backend de la API que permite gestionar los posts, categorias, etiquetas, usuarios y roles de usuarios del blog. Dependiendo del rol del usuario, se restringen o habilitan ciertas operaciones como la creación, edición o eliminación de las distintas entidades.

## Roles de Usuario
Admin: Acceso completo para crear, editar, eliminar y ver todas las entidades(posts, categorias, etiquetas, usuarios y roles de usuarios).
Blogger: Puede crear, editar y eliminar sus posts y tiene permisos solo para ver las categorias y etiquetas. No tiene permisos para realizar niguna acción respecto a usuarios ni roles.
Usuario: Solo tiene acceso a leer y ver las publicaciones sin capacidad de modificación.

## Tecnologías Utilizadas
Frontend: HTML, CSS, JavaScript, Tailwind CSS, Bootstrap 5.
Backend/API: API RESTful para gestionar posts, roles de usuario y las demas entidades.
Autenticación: JWT (JSON Web Tokens) para gestionar el inicio de sesión y la autorización.

## Autenticación
La autenticación se maneja con JWT (JSON Web Tokens). Los usuarios deben iniciar sesión para obtener un token, que luego debe ser enviado en el encabezado de las solicitudes API para realizar las operaciones protegidas (CRUD).

