<? require 'templates/header.php' ?>
<div class="container">
  <h1>Табличка с автомобилями</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Тип</th>
        <th scope="col">Марка</th>
        <th scope="col">Кол-во пассажирских мест</th>
        <th scope="col">Фото</th>
        <th scope="col">Кузов</th>
        <th scope="col">Грузоподъемность</th>
        <th scope="col">Дополнительно</th>
      </tr>
    </thead>
    <tbody>
        <? foreach ($cars as $car) { ?>
          <tr>
            <td>
              <?= $car->type ?>
            </td>
            <td>
                <?= $car->brand ?>
            </td>
            <td>
                <?= $car->passengerSeatsCount ?>
            </td>
            <td>
                <?= $car->photoFileName ?>
            </td>
            <td>
                <? if (isset($car->body)) { ?>
                  <?= $car->body->width . 'x' . $car->body->height . 'x' . $car->body->length ?>
                <? } ?>
            </td>
            <td>
                <?= $car->carrying ?>
            </td>
            <td>
                <?= $car->extra ?>
            </td>
          </tr>
        <? } ?>
    </tbody>
  </table>
</div>

<? require 'templates/footer.php' ?>
