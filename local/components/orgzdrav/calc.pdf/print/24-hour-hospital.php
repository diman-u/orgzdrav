<!doctype html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        .hr_tr {
            padding-bottom: 10px;
        }
        .hr_td {
            border-bottom: 1px solid #000000;
        }
        .ta_right {
            text-align: right;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td colspan="2">
            <h2>Результаты</h2>
            <div class="hr_tr">&nbsp;</div>
        </td>
    </tr>
    <?php foreach($content->data->titles as $key => $item):
        $key = array_search($key, array_column($content->result, 'name'));
    ?>
        <tr>
            <td><h3><?= $item ?></h3></td>
            <td class="ta_right"><?= round($content->result[$key]->deviation, 1); ?>%</td>
        </tr>
        <tr>
            <td>Фактическое значение</td>
            <td class="ta_right"><?= round($content->result[$key]->actual, 1); ?></td>
        </tr>
        <tr>
            <td>Норматив</td>
            <td class="ta_right"><?= round($content->result[$key]->norm, 1); ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="hr_tr">&nbsp;</div>
                <h4>Рекомендации</h4>
                <?= $content->result[$key]->description; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr/></td>
        </tr>
    <?php endforeach;?>

</table>

<pagebreak />

<table style="width: 100%">
    <tr>
        <td colspan="2">
            <h2>Исходные данные</h2>
            <div class="hr_tr">&nbsp;</div>
        </td>
    </tr>
    <tr>
        <td>
            <h3>Профиль специальности</h3>
            <div>врачи здравпунктов</div>
            <div class="hr_tr">&nbsp;</div>
        </td>
    </tr>
    <tr>
        <td>
            <h3>Период</h3>
            <div>
                <?= $content->data->monthList[$content->data->monthStart] ?> -
                <?= $content->data->monthList[$content->data->monthEnd] ?>
            </div>
            <div class="hr_tr">&nbsp;</div>
        </td>
    </tr>
    <tr><td><h3>Показатели</h3></td></tr>
    <tr>
        <td class="hr_td">Фактическое число коек по профилю</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->actual ?></td>
    </tr>
    <tr>
        <td class="hr_td">Среднегодовое число коек</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->averageAnnual ?></td>
    </tr>
    <tr>
        <td class="hr_td">Число поступивших больных</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->patients ?></td>
    </tr>
    <tr>
        <td class="hr_td">Число выписанных живыми за предыдущий год</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->dischargedPatients ?></td>
    </tr>
    <tr>
        <td class="hr_td">Число умерших в стационаре</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->diedPatients ?></td>
    </tr>
    <tr>
        <td class="hr_td">Проведено пациентами койко-дней</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->patientsBedDays ?></td>
    </tr>
    <tr>
        <td class="hr_td">Койко-дни, закрытия на ремонт</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->renovations ?></td>
    </tr>
    <tr>
        <td class="hr_td">Численность обслуживаемого населения</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->population ?></td>
    </tr>
    <tr>
        <td class="hr_td">Количество законченных случаев госпитализации по профилю</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->completedHospitalizations ?></td>
    </tr>
    <tr>
        <td class="hr_td">Число выписанных живыми за предыдущий год</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->dischargedPatientsPreviousYear ?></td>
    </tr>
    <tr>
        <td class="hr_td">Число умерших в стационаре за предыдущий год</td>
        <td class="hr_td" style="text-align: right"><?= $content->data->diedPatientsPreviousYear ?></td>
    </tr>
</table>
</body>
</html>