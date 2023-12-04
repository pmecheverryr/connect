<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# About Connect

Connect es una aplicación de blog dinámica y versátil diseñada para conectar a escritores apasionados con lectores de todo el mundo. Con un enfoque en la comunidad y el intercambio de conocimientos, Connect no solo facilita la creación de contenido atractivo, sino que también promueve la interacción y el aprendizaje mutuo entre sus usuarios

## Estructura del Proyecto:

### Blog Público:
Se implementó una sección de blog que incluye una lista de posts y una página para cada post. Cada página de post muestra información detallada del post junto con una ficha del autor.

#### API:
Se crearon dos endpoints:
GET: Para obtener los posts, incluyendo la información del autor en cada post.
POST: Para publicar un nuevo post. Aunque no se requirió una base de datos real, se simuló la inserción y se implementó validación de los datos enviados.

#### Principios de Desarrollo:

Se siguió una estructura backend cuidada, aplicando principios SOLID y una correcta separación de servicios y responsabilidades.
Se introdujeron interfaces para mejorar la modularidad y la capacidad de mantenimiento del código.
Se implementaron medidas para la tolerancia a fallos.
Herramientas y Tecnologías Utilizadas:

**Laravel:** Se utilizó la última versión estable de Laravel.
**PHP 8.*:** Se programó en PHP 8, cumpliendo con los requisitos de versión.
**Composer y PSR-4:** Se utilizó Composer para la gestión de dependencias y se siguió la estructura PSR-4.
**Testing Unitario:** Se incluyeron pruebas unitarias para asegurar el correcto funcionamiento del código.
**JSON:** La API devuelve y consume datos en formato JSON.
**Idioma:** Todo el código y comentarios están en inglés.
**SQLite:** Se utilizó SQLite para la base de datos, ya que no se requería una base de datos real.

#### Herramientas Adicionales:

**Análisis Estático y Estilo de Código:** Se utilizó PHPStan y PHP CS Fixer para garantizar la calidad y consistencia del código.
**SCSS y Webpack:** Se empleó SCSS para los estilos y Webpack (a través de Laravel Mix) para la compilación de assets.
**Swagger/OpenAPI:** Se proporcionó una documentación de la API utilizando Swagger/OpenAPI.
**Sonalint** Se utilizó Sonalint para analizar la calidad del código, proporcionando feedback en tiempo real mientras escribes el código. Esto es particularmente útil para identificar y corregir errores, vulnerabilidades de seguridad, y problemas de estilo de código de manera eficiente y oportuna.
La integración de SonarLint demuestra un compromiso con la calidad del código y las mejores prácticas de programación, ya que permite abordar los problemas en una etapa temprana del desarrollo.
Implementación de Qodana en el proyecto - Connect desarrollado con Laravel no solo mejora la calidad y seguridad del código, sino que también contribuye a un proceso de desarrollo más eficiente y colaborativo. Además, refleja un enfoque profesional y moderno hacia el desarrollo de software, alineándose con las expectativas de las prácticas actuales en la industria.
