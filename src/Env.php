<?php

namespace Lithe\Support;

use Dotenv\Dotenv;
use RuntimeException;

class Env
{
    /**
     * Loads environment variables from the .env file.
     *
     * This method checks for the existence of the .env file and loads
     * its contents into the environment. If the file does not exist,
     * an exception will be thrown.
     *
     * @param string $path Path to the .env file.
     * 
     * @throws RuntimeException If the .env file cannot be loaded.
     */
    public static function load(string $path)
    {
        // Check if the .env file exists in the specified path
        if (!file_exists($path . '/.env')) {
            throw new RuntimeException("The .env file was not found at: $path");
        }

        try {
            // Create a Dotenv instance and load the .env file
            $dotenv = Dotenv::createImmutable($path);
            $dotenv->safeLoad(); // Use safeLoad to avoid throwing exceptions for missing .env
        } catch (\Dotenv\Exception\InvalidPathException $e) {
            die("Error loading .env file: " . $e->getMessage());
        }
    }

    /**
     * Gets the value of an environment variable.
     *
     * This method retrieves the value of a specified environment variable
     * from the $_ENV superglobal. If the variable is not set, it returns
     * a default value.
     *
     * @param string $key Name of the environment variable.
     * @param mixed $default Default value to return if the variable is not set.
     * @return mixed Value of the environment variable or the default value.
     */
    public static function get(string $key, $default = null)
    {
        return $_ENV[$key] ?? $default; // Return the variable value or the default
    }

    /**
     * Sets an environment variable.
     *
     * This method sets the value of a specified environment variable
     * both in the $_ENV superglobal and using putenv.
     *
     * @param string $key Name of the environment variable.
     * @param mixed $value Value of the environment variable.
     */
    public static function set(string $key, $value)
    {
        putenv("$key=$value"); // Set the environment variable
        $_ENV[$key] = $value; // Update the $_ENV superglobal
    }

    /**
     * Checks if an environment variable is defined.
     *
     * This method checks whether a specified environment variable exists
     * in the $_ENV superglobal. It accepts either a string or an array
     * of keys to check.
     *
     * @param string|array $key Name of the environment variable or an array of names.
     * @return bool True if the variable(s) are defined, false otherwise.
     */
    public static function has($key): bool
    {
        if (is_array($key)) {
            // Check if all keys in the array are set
            foreach ($key as $k) {
                if (!isset($_ENV[$k])) {
                    return false; // Return false if any key is not set
                }
            }
            return true; // All keys are set
        }

        // Check if a single key is set
        return isset($_ENV[$key]);
    }
}
