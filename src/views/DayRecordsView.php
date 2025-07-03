<main class="content">
    <?php

    renderTitle(
        'Registrar Ponto',
        ' Mantenha seu ponto consistente!',
        'icofont-check-alt'
    );
    include(TEMPLATE_PATH . "/Messages.php");

    ?>

    <div class="card">
        <div class="card-header">
            <h3><?= $today ?></h3>
            <p class="mb-0">Os batimentos efetuados hoje</p>
        </div>
        <div class="card-body">
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 1: <?= $userRecords->time1 ?? '---' ?></span>
                <span class="record">Saída 1: <?= $userRecords->time2 ?? '---' ?></span>
            </div>
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 2: <?= $userRecords->time3 ?? '---' ?></span>
                <span class="record">Saída 2: <?= $userRecords->time4 ?? '---' ?></span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="Innout.php" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1"></i>
                Bater o Ponto
            </a>
        </div>
    </div>
    <form class="mt-5" action="innout.php" method="post">
        <div class="input-group no-border">
            <input type="text" name="forcedTime" class="form-control"
            placeholder="Informe a hora para simular o batimento">
            <button class="btn btn-danger ml-3">
                Simular Ponto
            </button>
        </div>

    </form>
</main>