<? require 'header.php' ?>
<div class="container">
  <h1>Табличка с автомобилями</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Тип</th>
        <th scope="col">Брэнд</th>
        <th scope="col">Количество пассажирских мест</th>
        <th scope="col">Имя файла</th>
        <th scope="col">Кузов</th>
        <th scope="col">Грузоподъемность</th>
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

<? require 'footer.php' ?>
