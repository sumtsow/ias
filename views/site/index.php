<?php

/* @var $this yii\web\View */

$this->title = 'Навантаження по дисциплінах';
?>
<div class="content">
    <ul class="nav nav-tabs" id="nav-tab" role="tablist">
        <li  class="nav-item active">
        <a class="nav-link" id="nav-index-tab" data-toggle="tab" href="#nav-index" role="tab" aria-controls="nav-index" aria-selected="true">Навантаження по дисциплінах</a>
        </li>
        <li  class="nav-item">
        <a class="nav-link" id="nav-prof-tab" data-toggle="tab" href="#nav-prof" role="tab" aria-controls="nav-prof" aria-selected="false">Навантаження по викладачах</a>
        </li>
        <li  class="nav-item">
        <a class="nav-link" id="nav-state-tab" data-toggle="tab" href="#nav-state" role="tab" aria-controls="nav-state" aria-selected="false">Особовий склад</a>
        </li>
    </ul>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-index" role="tabpanel" aria-labelledby="nav-index-tab">
    <table class="table table-striped table-hover mt-0">
    <thead class="thead-inverse">
    <tr>
        <th scope="col">Дисципліна</th>
        <th scope="col">Потік</th>
        <th scope="col">Студ.</th>
        <th scope="col">Усього</th>
        <th scope="col">Лк</th>
        <th scope="col">ПЗ</th>
        <th scope="col">Лб</th>
        <th scope="col">Конс.</th>
        <th scope="col">КП</th>
        <th scope="col">Конт.</th>
        <th scope="col">Сем.К</th>
        <th scope="col">Дипл.</th>
        <th scope="col">ДЕК</th>
        <th scope="col">Асп.</th>
        <th scope="col">Прак.</th>
        <th scope="col">Маг.</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>(У) Інтернет-технології</td>
        <td>КІз-15-1</td>
        <td>20</td>
        <td>4</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>4</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
        <tr>
        <td>Інтернет-технології</td>
        <td>КІз-15-1, КІз-15-1,</td>
        <td>20</td>
        <td>4</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>4</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    </tbody>
</table>
    </div>
            <div class="tab-pane fade" id="nav-prof" role="tabpanel" aria-labelledby="nav-prof-tab">
<table class="table table-striped table-hover mt-0">
    <thead>
    <tr>
        <th scope="col">Викладач</th>
        <th scope="col">Діапаз.</th>
        <th scope="col">За рік</th>
        <th scope="col">Осін.</th>
        <th scope="col">Весн.</th>        
        <th scope="col">Лек</th>
        <th scope="col">Прак.</th>
        <th scope="col">Лаб.</th>
        <th scope="col">Конс.</th>
        <th scope="col">Курс.</th>
        <th scope="col">Конт.</th>
        <th scope="col">Сем.</th>
        <th scope="col">Дип.</th>
        <th scope="col">ДЕК</th>
        <th scope="col">Асп.</th>
        <th scope="col">КерПр.</th>
        <th scope="col">КерМаг.</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Аксак Н.Г. (Професор)</td>
        <td>450-600</td>
        <td>600</td>
        <td>587</td>
        <td>13</td>
        <td>78</td>
        <td>&nbsp;</td>        
        <td>16</td>
        <td>106</td>
        <td>48</td>
        <td>58</td>
        <td>88</td>
        <td>11</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>50</td>
        <td>145</td>
    </tr>
        <tr>
        <td>Аксак Н.Г. (Професор)</td>
        <td>225-300</td>
        <td>297</td>
        <td>295</td>
        <td>2</td>
        <td>28</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>8</td>
        <td>117</td>
        <td>16</td>
        <td>20</td>
        <td>&nbsp;</td>
        <td>25</td>
        <td>5</td>
        <td>20</td>
        <td>58</td>
    </tr>
    </tbody>
</table>
            </div>
            <div class="tab-pane fade" id="nav-state" role="tabpanel" aria-labelledby="nav-state-tab">
<table class="table table-striped table-hover mt-0">
    <thead class="thead-inverse">
    <tr>
        <th scope="col">ПІБ</th>
        <th scope="col">Посада</th>
        <th scope="col">Ставка</th>
        <th scope="col">Мін. год.</th>
        <th scope="col">Макс. год.</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Аксак Н.Г.</td>
        <td>Професор</td>
        <td>1</td>
        <td>450</td>
        <td>600</td>
    </tr>
    <tr>
        <td>Аксак Н.Г.</td>
        <td>Професор</td>
        <td>0,5</td>
        <td>225</td>
        <td>300</td>
    </tr>
    </tbody>
</table>
            </div>
</div>
</div>
