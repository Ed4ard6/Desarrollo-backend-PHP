<?php

class Validator 
{
    protected $errors = [];

    public function __construct(
        protected array $data,      // Los datos del formulario ($_POST)
        protected array $rules = [] // Las reglas de validación
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        foreach ($this->rules as $field => $rules) {
            $rules = explode('|', $rules);
            $value = trim($this->data[$field] ?? '');

            foreach ($rules as $rule) {
                [$name, $param] = array_pad(explode(':', $rule), 2, null);

                $error = match ($name) {
                    'required' => empty($value) ? "$field es obligatorio." : null,
                    'min'      => strlen($value) < $param ? "$field debe tener al menos $param caracteres." : null,
                    'max'      => strlen($value) > $param ? "$field no debe superar $param caracteres." : null,
                    'url'      => filter_var($value, FILTER_VALIDATE_URL) === false ? "$field debe ser una URL válida." : null,
                    default    => null,
                };

                if ($error) {
                    $this->errors[$field][] = $error;
                    break; // Si hay error, no sigue validando esa regla
                }
            }
        }
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
