<?php

namespace myfrm;

use myfrm\App;

class Validator
{
    protected array $errors = [];
    protected array $data_items;
    protected array $rulesList = ['required', 'min', 'max', 'email', 'match', 'unique', 'ext', 'size'];
    protected array $messages = [
        'required' => 'The :fieldname: field is required',
        'min' => 'The :fieldname: field must be a minimun :rulevalue: characters',
        'max' => 'The :fieldname: field must be a maximum :rulevalue: characters',
        'email' => 'Not valid email',
        'match' => 'The :fieldname: field must match :rulevalue: characters',
        'unique' => 'The :fieldname: field must be unique',
        'ext' => 'The :fieldname: field must be a valid extension',
        'size' => 'The :fieldname: field must be :rulevalue: characters',
    ];

    public function validate(array $data, array $rules): Validator
    {
        $this->data_items = $data;
        foreach ($data as $fieldName => $value) {
            if (isset($rules[$fieldName])) {
                $this->check([
                    'fieldName' => $fieldName,
                    'value' => $value,
                    'rules' => $rules[$fieldName]
                ]);
            }
        }
        return $this;
    }

    public function check(array $field): void
    {

        foreach ($field['rules'] as $rule => $ruleValue) {
            if (in_array($rule, $this->rulesList)) {
                if (!call_user_func_array([$this, $rule], [$field['value'], $ruleValue])) {
                    $this->addError($field['fieldName'], str_replace([':fieldname:', ':rulevalue:'], [$field['fieldName'], $ruleValue], $this->messages[$rule]));
                }
            }
        }
    }

    public function match($value, $ruleValue): bool
    {
        return $value == $this->data_items[$ruleValue];
    }

    protected function addError(string $fieldName, string $error)
    {
        $this->errors[$fieldName][] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function listErrors($fieldName)
    {
        $output = '';
        if (isset($this->errors[$fieldName])) {
            $output .= "<div class='alert alert-danger' role='alert'><ul class='list-unstyled'>";
            foreach ($this->errors[$fieldName] as $error) {
                $output .= "<li>$error</li>";
            }
            $output .= "</ul></div>";
        }
        return $output;
    }


    protected
    function required($value, $rule_value): bool
    {
        return !empty($value);
    }

    protected
    function min($value, $rule_value): bool
    {
        return mb_strlen(removeUnwantedCharacters($value, 'UTF-8')) >= $rule_value;
    }

    protected
    function max($value, $rule_value): bool
    {
        return mb_strlen(removeUnwantedCharacters($value), 'UTF-8') <= $rule_value;
    }

    protected function email($value, $rule_value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function unique(string $value, $rule_value): bool
    {
        $db = App::get(Db::class);
        $data = explode(':', $rule_value);;
        return (!$db->query("SELECT {$data[1]} FROM {$data[0]} WHERE {$data[1]} = ?", [$value])->getColumnCount());
    }

    protected function ext($value, $rule_value): bool
    {
        if (isset($value['name'])) {
            return checkImage($value['name'][0], $rule_value);
        }
        return false;
    }

    protected function size(array $value, int $rule_value): bool
    {
        return isset($value['size']) && $value['size'] <= $rule_value;
    }
}