# Blogflow - Blog web con gestión de Usuarios, Roles y CRUD
Este repositorio contiene el código de una aplicación web que interactúa con la API RESTful <a href="https://github.com/Manuel-Ayusa/blog-api" target="_blank"><b>Blog API</b></a>. La aplicación permite a los usuarios realizar operaciones CRUD sobre las publicaciones del blog y gestiona diferentes roles de usuario (Admin, Blogger, user) con permisos específicos. Ademas el sitio interactúa con la API para obtener los datos de los posts y presentarlos en una interfaz de usuario amigable.

## Descripción
La aplicación está diseñada para proporcionar una interfaz de usuario para interactuar con el backend de la API que permite gestionar los posts, categorias, etiquetas, usuarios y roles de usuarios del blog. Dependiendo del rol del usuario, se restringen o habilitan ciertas operaciones como la creación, edición o eliminación de las distintas entidades.

## Roles de Usuario
<b>Admin</b>: Acceso completo para crear, editar, eliminar y ver todas las entidades(posts, categorias, etiquetas, usuarios y roles de usuarios). <br>
<b>Blogger</b>: Puede crear, editar y eliminar sus posts y tiene permisos solo para ver las categorias y etiquetas. No tiene permisos para realizar niguna acción respecto a usuarios ni roles. <br>
<b>User</b>: Solo tiene acceso a leer y ver las publicaciones sin capacidad de modificación.

## Autenticación
La autenticación se maneja con JWT (JSON Web Tokens). Los usuarios deben iniciar sesión para obtener un token, que luego es enviado en el encabezado de las solicitudes HTTP para realizar las operaciones protegidas (CRUD).

## Tecnologías Utilizadas
<b>Frontend</b>: HTML, CSS, JavaScript, Tailwind CSS, Bootstrap 5. <br>
<b>Backend/API</b>: API RESTful para gestionar posts, roles de usuario y las demas entidades. <br>
<b>Autenticación</b>: JWT para gestionar el inicio de sesión y la autorización. <br>

## Autor
Manuel Alejandro Ayusa - Programador y Desarrollador web <br>
<a href="mailto:ayusamanuel6@gmail.com">ayusamanuel6@gmail.com</a> <br>
<a href="https://www.linkedin.com/in/manuel-alejandro-ayusa-aa7415282/">Linkedin</a>

