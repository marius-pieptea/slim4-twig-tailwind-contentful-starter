# Slim 4, Twig, Tailwind CSS Boilerplate with Contentful CMS Integration

[![License: MIT](https://opensource.org/licenses/MIT)](https://opensource.org/licenses/MIT)

## Project Description

This boilerplate provides a foundation for building fast, flexible, and modern websites using the Slim 4 micro-framework, Twig templating engine, and Tailwind CSS for styling. It is designed to be easily integrated with Contentful CMS, offering a powerful headless CMS solution for managing content. This stack is ideal for simple websites, blogs, portfolios, and landing pages that require a balance of performance, customization, and ease of content management.

## Technologies Used

This boilerplate leverages the following technologies:

- **Backend Framework:** [Slim Framework 4](https://www.slimframework.com/) - A fast and lightweight PHP micro-framework for routing and middleware.
- **Templating Engine:** [Twig](https://twig.symfony.com/) - A flexible, fast, and secure template engine for PHP.
- **CSS Framework:** [Tailwind CSS](https://tailwindcss.com/) - A utility-first CSS framework for rapid UI development and consistent design.
- **Headless CMS:** [Contentful](https://www.contentful.com/) - A flexible and scalable Content Management System that provides content via APIs.
- **Environment Management:** [DotEnv](https://github.com/vlucas/phpdotenv) - For managing environment variables using `.env` files.
- **HTTP Client:** [Guzzle HTTP Client](https://docs.guzzlephp.org/en/stable/) - For making HTTP requests (primarily used by the Contentful SDK).

## Features

- **Fast Performance:** Slim 4 micro-framework ensures optimal speed and responsiveness.
- **Clean and Organized Structure:** Well-structured codebase for maintainability and scalability.
- **Contentful Integration:** Seamlessly integrates with Contentful CMS to fetch and display content.
- **Rich Text Rendering:** Utilizes the Contentful Rich Text Renderer to display rich text content from Contentful.
- **Modern Styling:** Tailwind CSS provides a utility-first approach for rapid and consistent styling.
- **Secure Configuration:** `.htaccess` file configured with security best practices.
- **Environment Variables:** Uses `.env` files to manage sensitive configuration details.
- **Routing:** Slim 4 routing for clean and organized URL structure.
- **Templating:** Twig templating engine for efficient and secure template rendering.
- **Error Handling:** Custom error handler for Contentful specific exceptions.

## Requirements

- **PHP:** 8.1 or higher (Optimized for PHP 8.4 based on project configuration)
- **PHP Extensions:**
  - `mbstring`
  - `dom`
  - `json`
- **Composer:** [Composer](https://getcomposer.org/) - PHP dependency manager

## Setup Instructions

### 1. Clone the Repository

```bash
git clone [repository-url]
cd [repository-directory]
```

### 2. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Open the `.env` file and configure your Contentful credentials:

```ini
CONTENTFUL_SPACE_ID=your_space_id
CONTENTFUL_ACCESS_TOKEN=your_content_delivery_api_access_token
CONTENTFUL_ENVIRONMENT=master
```

### 3. Install Dependencies

Run Composer to install the project dependencies:

```bash
composer install
```

### 4. Web Server Configuration

#### For Apache:

- Ensure `mod_rewrite` is enabled.
- Set the `AllowOverride` directive to `All` for the `public` directory.

#### For Nginx:

```nginx
server {
    listen 80;
    server_name your-domain.local;
    root /path/to/your/project/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

### 5. Running the Application

Use PHP's built-in web server for development:

```bash
php -S localhost:8080 -t public
```

Then, access your application in your browser at `http://localhost:8080`.

## Working with Contentful CMS

### 1. Content Modeling in Contentful

- Define your content models in the Contentful web interface (e.g., Blog Post, Portfolio Item).
- Add fields to your content models to structure your content (e.g., title, body, image, slug).

### 2. Fetching Content in Your Application

Example: Fetching Blog Posts

```php
<?php
use Contentful\Delivery\Client;

$client = new Client(
    $_ENV['CONTENTFUL_ACCESS_TOKEN'],
    $_ENV['CONTENTFUL_SPACE_ID'],
    $_ENV['CONTENTFUL_ENVIRONMENT']
);

$entries = $client->getEntries(['content_type' => 'blogPost']);
foreach ($entries as $entry) {
    $title = $entry->get('title');
    $body = $entry->get('body');
}
```

### 3. Rendering Content in Templates

Example: Displaying Blog Post in Twig Template

```twig
{% extends 'layouts/base.html.twig' %}
{% block content %}
    <article>
        <h1>{{ post.title }}</h1>
        <div class="blog-body">
            {{ post.body|raw }}
        </div>
    </article>
{% endblock %}
```

### 4. Handling Rich Text

Example (Controller):

```php
<?php
use Contentful\RichText\Parser;
use Contentful\RichText\Renderer;

$parser = new Parser();
$document = $parser->parse($richTextData);
$renderer = new Renderer();
$renderedHtml = $renderer->render($document);
```

## Routing

Example Route Definition:

```php
$app->get('/', [HomeController::class, 'index'])->setName('home');
$app->group('/blog', function (RouteCollectorProxy $group) {
    $group->get('', [BlogController::class, 'index'])->setName('blog.index');
    $group->get('/{slug}', [BlogController::class, 'show'])->setName('blog.show');
});
```

## Development Workflow

1. **Define Content Models in Contentful.**
2. **Update Application Code.**
3. **Fetch and Render Content.**
4. **Template Design with Tailwind CSS.**
5. **Local Development & Testing.**
6. **Deploy.**

## Security Features

- **`.htaccess` Security** for Apache.
- **Input Encoding and Output Escaping** in Twig.
- **Content Security Policy (CSP).**
- **Regular Dependency Updates.**
- **Secure Environment Variables.**

## Additional Resources

- [Slim Framework Docs](https://www.slimframework.com/docs/)
- [Twig Documentation](https://twig.symfony.com/doc/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Contentful PHP SDK](https://github.com/contentful/contentful.php)

## Author

[Marius Pieptea](https://github.com/marius-pieptea)

---

This README provides a comprehensive technical overview and setup guide for the Slim 4, Twig, and Tailwind CSS boilerplate with Contentful integration. Use this as a starting point and customize it further to reflect the specific features and functionalities of your project.
