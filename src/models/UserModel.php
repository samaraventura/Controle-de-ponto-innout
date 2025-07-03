<?php

class UserModel extends BaseModel
{
  protected static $tableName = 'users';
  protected static $columns = [
    'id',
    'name',
    'password',
    'email',
    'start_date',
    'end_date',
    'is_admin',
  ];

  public static function  getActiveUserCount()
  {
    return static::getCount(['raw' => 'end_date IS NULL']);
  }

  public function insertUser()
  {
    $this->validate();
    $this->is_admin = $this->is_admin ? 1 : 0;

    if (!$this->end_date) $this->end_date = null;

    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::insert();
  }

  public function updateUser()
  {
    $this->validate();
    $this->is_admin = $this->is_admin ? 1 : 0;

    if (!$this->end_date) $this->end_date = null;
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::update();
  }

  public function validate()
  {
    $errors = [];

    if (!$this->name) {
      $errors['name'] = 'Nome é obrigatório.';
    }

    if (!$this->email) {
      $errors['email'] = 'Email é obrigatório.';
    
    } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email inválido ";
    }

    if (!$this->password) {
      $errors['password'] = 'Senha é obrigatória.';
    }

    if (!$this->confirm_password) {
      $errors['confirm_password'] = 'Confirmação de senha é obrigatório.';
    }
    
    if (
      $this->password && $this->confirm_password
      &&  $this->password !== $this->confirm_password) 
    {
      $errors['password'] = 'As senhas não são iguais.';
      $errors['confirm_password'] = 'As senhas não são iguais.';
    }

    if (!$this->start_date) {
      $errors['start_date'] = "Data de Admissão é obrigatória";
    
    } elseif (!DateTime::createFromFormat('Y-m-d', $this->start_date)) {
      $errors['start_date'] = "Data de Admissão está no formato incorreto";
    }

    if ($this->end_date && !DateTime::createFromFormat('Y-m-d', $this->end_date)) {
      $errors['end_date'] = "Data de desligamento está no formato incorreto";
    }

    // Adicione mais validações conforme necessário

    if ($errors) {
      throw new ValidationException($errors);
    }
  }
}
