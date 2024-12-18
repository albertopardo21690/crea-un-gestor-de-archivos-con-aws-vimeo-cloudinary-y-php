# File Manager System (FMS)

Este es un **File Manager System (FMS)**, un sistema de gestión de archivos que permite administrar, organizar y visualizar archivos almacenados en diferentes plataformas, como **AWS S3**, **Cloudinary**, y más. El sistema proporciona una interfaz fácil de usar para realizar acciones como buscar, agregar, eliminar archivos, y gestionar carpetas.

## Características

- **Interfaz de usuario moderna** utilizando **Bootstrap** y **FontAwesome**.
- **Búsqueda de archivos** mediante un campo de entrada con filtro de tipo de archivo.
- **Visualización en vista de lista** o **vista de cuadrícula**.
- **Cargar archivos** arrastrando y soltando.
- **Gestión de carpetas** y visualización de su progreso.
- **Visualización de metadatos** de archivos, como nombre, tamaño, y fecha de modificación.
- **Botones de acción** para realizar operaciones como copiar o eliminar archivos.

## Requisitos

- Servidor web que soporte PHP (si se necesita).
- Conexión a internet para los recursos de terceros como Bootstrap y FontAwesome.

## Instalación

1. Clona o descarga este repositorio.
2. Coloca los archivos en el directorio de tu servidor web.
3. Asegúrate de tener los recursos locales y de red necesarios (por ejemplo, enlaces a librerías externas de Bootstrap, jQuery, etc.).
4. Configura las rutas a tus recursos estáticos si es necesario.
5. Ejecuta el sistema en tu servidor web.

## Uso

### Navegación

- **Inicio de sesión**: Haz clic en "Login" para acceder al sistema.
- **Buscar archivos**: Usa la barra de búsqueda para encontrar archivos rápidamente.
- **Subir archivos**: Arrastra y suelta los archivos en el área indicada o haz clic en el botón "Add Files".
- **Gestionar archivos**: Copia, elimina o consulta el enlace a los archivos almacenados.

### Vista de archivo

- En la vista de **lista** puedes ver una tabla con las columnas de **nombre**, **tamaño**, **carpeta**, **enlace**, **modificación** y **acciones**.
- En la vista de **cuadrícula** puedes ver una representación más compacta de los archivos con opciones de gestión.

## Estructura del Proyecto

El proyecto está compuesto por los siguientes elementos principales:

- **HTML**: Estructura base de la página.
- **CSS**: Estilos para el diseño visual y la apariencia.
- **JavaScript**: Funcionalidad para la interacción con el usuario y manejo de archivos.
- **Modal de login**: Para permitir la autenticación de los usuarios.
  
### Archivos y Dependencias

- **Bootstrap 5**: Para el diseño y los componentes interactivos.
- **jQuery**: Para la manipulación del DOM y eventos.
- **FontAwesome y Bootstrap Icons**: Para los íconos en la interfaz de usuario.
- **SweetAlert**: Para mostrar mensajes emergentes.
- **Toastr**: Para notificaciones.

## Contribuciones

Si deseas contribuir a este proyecto, por favor abre un **pull request** con tus cambios o **inicia un problema** si encuentras algún bug o tienes una mejora que proponer.

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## Autores

- Desarrollado por [Tu Nombre o Equipo]
