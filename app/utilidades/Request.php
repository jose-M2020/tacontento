<?php
require_once 'InputSanitizer.php';

class Request {
  protected $data;
  protected $headers;
  protected $cookies;
  protected $files;

  public function __construct() {
      $this->data = array_merge($_POST, $_GET);
      $this->headers = $this->getRequestHeaders();
      $this->cookies = $_COOKIE;
      $this->files = $_FILES;
      $this->sanitize(); // Automatically sanitize the data
  }

  public function input($key, $default = null) {
      return $this->data[$key] ?? $default;
  }

  public function all() {
      return $this->data;
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

  public function query() {
      return $_SERVER['QUERY_STRING'];
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

