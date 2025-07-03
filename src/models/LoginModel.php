<?php

class Login extends BaseModel
{
    public function Validate() {
        $errors = [];

        if(!$this->email) {
            $errors['email'] = 'E-mail é um campo obrigatório.';
        }

        if(!$this->password) {
            $errors['password'] = 'Por favor, informe a senha.';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

    public function checkLogin()
    {
        $this->validate();
        $user = UserModel::getOne(['email' => $this->email]);
        $user = !empty($user->values) ? (object) $user->values : null;
        
            if (isset($user->end_date) && $user->end_date) {
                throw new AppException('Usuário está desligado da empresa');
            }
            if (isset($user->password) && (password_verify($this->password, $user->password))) {
                return $user;
            }

            throw new AppException('Usuário e Senha inválidos');
        
    }
}
