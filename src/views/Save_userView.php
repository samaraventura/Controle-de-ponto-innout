<main class="content">
    <?php
    renderTitle(
        'Cadastro de Usuário',
        'Crie e atualize o usuário',
        'icofont-user'
    );

    include(TEMPLATE_PATH . "/Messages.php");

    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Informe o nome"
                    class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                    value="<?= $name ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['name'] ?? '' ?>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Informe o email"
                    class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                    value="<?= $email ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['email'] ?? '' ?>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Informe a senha"
                    class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['password'] ?? '' ?>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="confirm_password">Confirmação de Senha</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme a senha"
                    class="form-control <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['confirm_password'] ?? '' ?>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="start_date">Data de Admissão</label>
                <input type="date" id="start_date" name="start_date"
                    class="form-control <?= isset($errors['start_date']) ? 'is-invalid' : '' ?>"
                    value="<?= $start_date ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['start_date'] ?? '' ?>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="end_date">Data de Desligamento</label>
                <input type="date" id="end_date" name="end_date"
                    class="form-control <?= isset($errors['end_date']) ? 'is-invalid' : '' ?>"
                    value="<?= $end_date ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['end_date'] ?? '' ?>
                </div>
            </div>
        </div>

        <div class="form-row align-items-center">
            <div class="form-group col-md-6">
                <label for="is_admin">Administrador?</label><br>
                <input type="checkbox" id="is_admin" name="is_admin" value="1"
                    <?= !empty($is_admin) ? 'checked' : '' ?>>
                <div class="invalid-feedback d-block">
                    <?= $errors['is_admin'] ?? '' ?>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="UsersController.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</main>