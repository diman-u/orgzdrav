<!doctype html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        .hr_tr {
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
<table>
    <tr>
        <td colspan="2">
            <h2>Результаты staff</h2>
            <div class="hr_tr">&nbsp;</div>
        </td>
    </tr>
    <?php foreach($content->data->titles as $key => $item):
        $key = array_search($key, array_column($content->result, 'name'));
    ?>
        <tr>
            <td><h3><?= $item ?></h3></td>
            <td><?= round($content->result[$key]->deviation, 1); ?>%</td>
        </tr>
        <tr>
            <td>Фактическое значение</td>
            <td><?= round($content->result[$key]->actual, 1); ?></td>
        </tr>
        <tr>
            <td>Норматив</td>
            <td><?= round($content->result[$key]->norm, 1); ?></td>
        </tr>
        <tr>
            <td>
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
            <div>Январь - Июнь</div>
            <div class="hr_tr">&nbsp;</div>
        </td>
    </tr>
    <tr><td><h3>Показатели</h3></td></tr>
    <tr>
        <td>Число штатных должностей врачей в целом по организации</td>
        <td style="text-align: right"><?= $content->data->p01 ?></td>
    </tr>
    <tr>
        <td>Число штатных должностей врачей в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</td>
        <td style="text-align: right"><?= $content->data->p02 ?></td>
    </tr>
    <tr>
        <td>Число штатных должностей врачей в подразделениях, оказывающих медицинскую помощь в стационарных условиях</td>
        <td style="text-align: right"><?= $content->data->p03 ?></td>
    </tr>
    <tr>
        <td>Число занятых должностей врачей в целом по организации</td>
        <td style="text-align: right"><?= $content->data->p04 ?></td>
    </tr>
    <tr>
        <td>Число занятых должностей врачей в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</td>
        <td style="text-align: right"><?= $content->data->p05 ?></td>
    </tr>
    <tr>
        <td>Число занятых должностей врачей в подразделениях, оказывающих медицинскую помощь в стационарных условиях</td>
        <td style="text-align: right"><?= $content->data->p06 ?></td>
    </tr>
    <tr>
        <td>Численность обслуживаемого населения</td>
        <td style="text-align: right"><?= $content->data->p07 ?></td>
    </tr>
    <tr>
        <td>Число физических лиц врачей основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</td>
        <td style="text-align: right"><?= $content->data->p08 ?></td>
    </tr>
    <tr>
        <td>Число физических лиц врачей основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в стационарных условиях</td>
        <td style="text-align: right"><?= $content->data->p09 ?></td>
    </tr>
    <tr>
        <td>Численность обслуживаемого населения</td>
        <td style="text-align: right"><?= $content->data->p10 ?></td>
    </tr>
    <tr>
        <td>Число штатных должностей среднего медицинского персонала (СМП) в целом по организации</td>
        <td style="text-align: right"><?= $content->data->p11 ?></td>
    </tr>
    <tr>
        <td>Число штатных должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</td>
        <td style="text-align: right"><?= $content->data->p12 ?></td>
    </tr>
    <tr>
        <td>Число штатных должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в стационарных условиях</td>
        <td style="text-align: right"><?= $content->data->p13 ?></td>
    </tr>
    <tr>
        <td>Число занятых должностей среднего медицинского персонала (СМП) в целом по организации</td>
        <td style="text-align: right"><?= $content->data->p14 ?></td>
    </tr>
    <tr>
        <td>Число занятых должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</td>
        <td style="text-align: right"><?= $content->data->p15 ?></td>
    </tr>
    <tr>
        <td>Число занятых должностей среднего медицинского персонала в подразделениях, оказывающих медицинскую помощь в стационарных условиях</td>
        <td style="text-align: right"><?= $content->data->p16 ?></td>
    </tr>
    <tr>
        <td>Число физических лиц среднего медицинского персонала основных работников на занятых должностях всего</td>
        <td style="text-align: right"><?= $content->data->p17 ?></td>
    </tr>
    <tr>
        <td>Число физических лиц среднего медицинского персонала основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в амбулаторных условиях</td>
        <td style="text-align: right"><?= $content->data->p18 ?></td>
    </tr>
    <tr>
        <td>Число физических лиц среднего медицинского персонала основных работников на занятых должностях в подразделениях, оказывающих медицинскую помощь в стационарных условиях</td>
        <td style="text-align: right"><?= $content->data->p19 ?></td>
    </tr>
</table>
</body>
</html>

