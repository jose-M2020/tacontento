<?php
namespace App\Utilities;

use Closure;

class Request {
  protected $data;
  private $query;
  protected $headers;
  protected $cookies;
  protected $files;

  public function __construct() {
      $this->data = array_merge($_POST, $_GET);
      $this->query = $_GET;
      $this->headers = $this->getRequestHeaders();
      $this->cookies = $_COOKIE;
      $this->files = $_FILES;
      $this->sanitize(); // Automatically sanitize the data
  }

  public function all() {
    return $this->data;
  }

  public function input($name = null, $default = null)
  {
    if ($name === null) {
        // If no argument provided, return all of the input values as an associative array
        return $this->data;
    } else {
        // Retrieve a specific input value by name, or return null if it doesn't exist
        return isset($this->data[$name]) ? $this->data[$name] : $default;
    }
  }

  public function query($name = null, $default = null)
  {
    if ($name === null) {
        return $this->query;
    } else {
        return isset($this->query[$name]) ? $this->query[$name] : $default;
    }
  }

  public function boolean($name, $default = false)
  {
    // Retrieve a specific input value by name and convert it to a boolean based on the rules
    $value = $this->input($name);
    $boolValues = [1, "1", true, "true", "on", "yes"];
    return in_array($value, $boolValues) ? true : $default;
  }

  public function only($keys) {
      return array_intersect_key($this->data, array_flip((array) $keys));
  }

  public function except($keys) {
      return array_diff_key($this->data, array_flip((array) $keys));
  }

  public function json($key = null, $default = null) {
      // Implement JSON data handling logic if needed
      $jsonData = json_decode(file_get_contents('php://input'), true);
      if ($jsonData === null) {
          return $default;
      }
      return $key ? ($jsonData[$key] ?? $default) : $jsonData;
  }

  public function file($key) {
      return $this->files[$key] ?? null;
  }

  public function hasFile($key) {
      return isset($this->files[$key]);
  }

  public function has($keys)
    {
        // Determine if a value is present on the request
        if (!is_array($keys)) {
            return isset($this->data[$keys]);
        }

        // Determine if all of the specified values are present
        foreach ($keys as $key) {
            if (!isset($this->data[$key])) {
                return false;
            }
        }
        return true;
    }

    public function hasAny($keys)
    {
        // Determine if any of the specified values are present
        if (!is_array($keys)) {
            $keys = func_get_args();
        }

        foreach ($keys as $key) {
            if (isset($this->data[$key])) {
                return true;
            }
        }
        return false;
    }

    public function whenHas($key, Closure $callback, Closure $default = null)
    {
        // Execute the given closure if a value is present on the request
        if (isset($this->data[$key])) {
            return $callback($this->data[$key]);
        }

        // Execute the second closure if the specified value is not present on the request
        if ($default) {
            return $default();
        }

        return null;
    }

    public function filled($key)
    {
        // Determine if a value is present on the request and is not an empty string
        return isset($this->data[$key]) && $this->data[$key] !== '';
    }

    public function anyFilled($keys)
    {
        // Determine if any of the specified values is not an empty string
        if (!is_array($keys)) {
            $keys = func_get_args();
        }

        foreach ($keys as $key) {
            if (isset($this->data[$key]) && $this->data[$key] !== '') {
                return true;
            }
        }
        return false;
    }

    public function whenFilled($key, Closure $callback, Closure $default = null)
    {
        // Execute the given closure if a value is present on the request and is not an empty string
        if (isset($this->data[$key]) && $this->data[$key] !== '') {
            return $callback($this->data[$key]);
        }

        // Execute the second closure if the specified value is not "filled"
        if ($default) {
            return $default();
        }

        return null;
    }






  public function method() {
      return $_SERVER['REQUEST_METHOD'];
  }

  public function isMethod($method) {
      return strtoupper($method) === $this->method();
  }

  public function url() {
      return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

  public function route() {
      return strtok($_SERVER['REQUEST_URI'], '?');
  }

  public function header($key, $default = null) {
      $key = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
      return $this->headers[$key] ?? $default;
  }

  public function cookie($key, $default = null) {
      return $this->cookies[$key] ?? $default;
  }

  public function path() {
      return strtok($_SERVER['REQUEST_URI'], '?');
  }

  public function validate(array $rules) {
      // Simple validation logic for demonstration purposes
      $validatedData = [];
      foreach ($rules as $field => $rule) {
          $value = $this->input($field);
          // Implement your validation logic here based on the rules
          // For example, you can use regular expressions or built-in functions
          if (strlen($value) > 0) {
              $validatedData[$field] = $value;
          }
      }
      $this->data = $validatedData;
  }

  public function sanitize() {
    $inputSanitizer = new InputSanitizer();
      $this->data = $inputSanitizer->sanitize($this->data);
  }

  protected function getRequestHeaders() {
      $headers = [];
      foreach ($_SERVER as $key => $value) {
          if (strpos($key, 'HTTP_') === 0) {
              $header = str_replace('_', ' ', substr($key, 5));
              $header = str_replace(' ', '-', ucwords(strtolower($header)));
              $headers[$header] = $value;
          }
      }
      return $headers;
  }
}

