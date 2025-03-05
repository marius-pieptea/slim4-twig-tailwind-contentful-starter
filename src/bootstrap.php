<?php

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables with debug information
try {
    if (!file_exists(__DIR__ . '/../.env')) {
        throw new RuntimeException('.env file not found');
    }

    if (!is_readable(__DIR__ . '/../.env')) {
        throw new RuntimeException('.env file is not readable');
    }

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    // Verify required variables are set
    $required = ['CONTENTFUL_SPACE_ID', 'CONTENTFUL_ACCESS_TOKEN'];
    foreach ($required as $var) {
        if (empty($_ENV[$var])) {
            throw new RuntimeException("Required environment variable {$var} is not set");
        }
    }
} catch (Exception $e) {
    die('Environment Error: ' . $e->getMessage());
}
