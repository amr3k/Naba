<?php

namespace System;

class Validation
{

    /**
     * Application object
     *
     * @var \System\App
     */
    private $app;

    /**
     * Errors container
     *
     * @var array
     */
    private $errors = [];

    /**
     * Constructor
     *
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Determine if the given input is not empty
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function required($inputName, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if ($input === '') {
//            $msg    =   $customErrMsg ? :   sprintf('%s Is Required', ucfirst($inputName));
            $msg = $customErrMsg ?: 'Please fill all required fields';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input file exists
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function requiredFile($inputName, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $file = $this->app->request->file($inputName);
        if (!$file->exists()) {
//            $msg    =   $customErrMsg ? :   sprintf('%s Is Required', ucfirst($inputName));
            $msg = $customErrMsg ?: 'Please submit a valid file';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input file is image
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function img($inputName, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $file = $this->app->request->file($inputName);
        if (!$file->exists()) {
            $msg = $customErrMsg ?: 'Please submit a valid image file';
            $this->addErr($inputName, $msg);
            return $this;
        }
        if (!$file->isImg()) {
//            $msg    =   $customErrMsg ? :   sprintf('%s Is Required', ucfirst($inputName));
            $msg = $customErrMsg ?: 'Please submit a valid image file';
            $this->addErr($inputName, $msg);
        }
        if ($file->maxSize(1)) {
            $msg = $customErrMsg ?: 'Image should be at least 1MB';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input is valid email
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function email($inputName, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
//            $msg =   $customErrMsg ? : sprintf('%s is not valid email', ucfirst($inputName));
            $msg = $customErrMsg ?: 'Please submit a valid email';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine it the input value string
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function valString($inputName, $customErrMsg = NULL)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if (!preg_match('~^[A-Za-z0-9\~\!\@\#\$\%\^\&\*\_\-\.\/\,\=\+\[\]\{\}]+$~', $input)) {
//            $msg =   $customErrMsg ? : sprintf('%s is not valid email', ucfirst($inputName));
            $msg = $customErrMsg ?: 'You can only use letters, digits and special characters';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine it the input value number
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function valNumber($inputName, $customErrMsg = NULL)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if (!filter_var($input, FILTER_VALIDATE_INT)) {
//            $msg =   $customErrMsg ? : sprintf('%s is not valid email', ucfirst($inputName));
            $msg = $customErrMsg ?: 'You can only use digits';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input has a float value
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function digit($inputName, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if (!is_float($input)) {
            $msg = $customErrMsg ?: 'Please type only digits';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input is a valid URL
     *
     * @param string $inputName
     * @param string $customErrMsg
     * @return $this
     */
    public function url($inputName, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if (!filter_var($input, FILTER_VALIDATE_URL)) {
            $msg = $customErrMsg ?: 'Please submit a valid URL';
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input is not less in length than the the given value
     *
     * @param string $inputName
     * @param int $length
     * @param string $customErrMsg
     * @return $this
     */
    public function min($inputName, $length, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if (strlen($input) < $length) {
            $msg = $customErrMsg ?: sprintf('%s must be at least %d characters', $inputName, $length);
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input is not more in length than the the given value
     *
     * @param string $inputName
     * @param int $length
     * @param string $customErrMsg
     * @return $this
     */
    public function max($inputName, $length, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input = $this->value($inputName);
        if (strlen($input) > $length) {
            $msg = $customErrMsg ?: sprintf('%s cannot be more than %d characters', $inputName, $length);
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Determine if the first input matches the second input
     *
     * @param string $firstInput
     * @param string $secondInput
     * @param string $customErrMsg
     * @return $this
     */
    public function match($firstInput, $secondInput, $customErrMsg = null)
    {
        // FIV = First Input Value
        $FIV = $this->value($firstInput);
        $SIV = $this->value($secondInput);
        if ($FIV !== $SIV) {
//            $msg =   $customErrMsg ? : sprintf('%s must match %s', ucfirst($secondInput), ucfirst($firstInput));
            $msg = $customErrMsg ?: 'Passwords are not matched';
            $this->addErr($secondInput, $msg);
        }
        return $this;
    }

    /**
     * Determine if the given input is unique in Database
     *
     * @param string $inputName
     * @param array $dbData
     * @param string $customErrMsg
     * @return $this
     */
    public function unique($inputName, array $dbData, $customErrMsg = null)
    {
        if ($this->hasErr($inputName)) {
            return $this;
        }
        $input                = $this->value($inputName);
        $table                = NULL;
        $column               = NULL;
        $exceptionColumn      = NULL;
        $exceptionColumnValue = NULL;
        if (count($dbData) == 2) {
            list($table, $column) = $dbData;
        } elseif (count($dbData == 4)) {
            list($table, $column, $exceptionColumn, $exceptionColumnValue) = $dbData;
        }
        if ($exceptionColumn && $exceptionColumnValue) {
            $results = $this->app->db->select($column)
                    ->from($table)
                    ->where($column . ' = ? AND ' . $exceptionColumn . ' != ?', $input, $exceptionColumnValue)
                    ->fetch();
        } else {
            $results = $this->app->db->select($column)
                    ->from($table)
                    ->where($column . ' = ?', $input)
                    ->fetch();
        }
        if ($results) {
            $msg = $customErrMsg ?: sprintf('%s already exists in our Database', ucfirst($inputName));
            $this->addErr($inputName, $msg);
        }
        return $this;
    }

    /**
     * Google ReCAPTCHA
     *
     * @return bool
     */
    public function recaptcha()
    {
        $curl     = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => 'https://www.google.com/recaptcha/api/siteverify',
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => [
                'secret'   => '6LfpiC0UAAAAABq6fGhoFJK575O4lQuk-23ksVsy',
                'response' => $this->app->request->post('g-recaptcha-response'),
            ],
        ]);
        $response = json_decode(curl_exec($curl));
        if (!$response->success) {
            $this->addErr('ReCAPTCHA', 'Please complete the recaptcha test');
        }
        return $this;
    }

    /**
     * Add custom message
     *
     * @param string $message
     * @return $this
     */
    public function msg($message)
    {
        $this->errors[] = $message;
        return $this;
    }

    /**
     * Validate all inputs
     *
     * @return $this
     */
    public function validate()
    {

    }

    /**
     * Determine if there are any invalid inputs
     *
     * @return bool
     */
    public function fail()
    {
        return !empty($this->errors);
    }

    /**
     * Determine if all inputs are valid
     *
     * @return bool
     */
    public function pass()
    {
        return empty($this->errors);
    }

    /**
     * Get all errors
     *
     * @return array
     */
    public function getMsg()
    {
        return $this->errors;
    }

    /**
     * Flatten errors and return them as normal string
     *
     * @return string
     */
    public function flatMsg()
    {
        return implode('<br>', $this->getMsg());
    }

    /**
     * Get the value for the given input name
     *
     * @param string $input
     * @return mixed
     */
    private function value($input)
    {
        return $this->app->request->post($input);
    }

    /**
     * Add input error
     *
     * @param string $inputName
     * @param string $errMsg
     * @return void
     */
    private function addErr($inputName, $errMsg)
    {
        if (!$this->hasErr($inputName)) {
            $this->errors[$inputName] = $errMsg;
        }
    }

    /**
     * Determine if the given input name has a previous error
     *
     * @param string $inputName
     * @return bool
     */
    private function hasErr($inputName)
    {
        return array_key_exists($inputName, $this->errors);
    }

}
