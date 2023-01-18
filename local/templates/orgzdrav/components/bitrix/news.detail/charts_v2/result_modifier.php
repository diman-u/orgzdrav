<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['chartsdata'] = json_decode($arResult['DISPLAY_PROPERTIES']['DATA']['~VALUE'], true);

// TODO - разные варианты преобразования
if (true) {
	$arResult['chartsdata']['VALUES'][0] = [
		'ОКС',
		'Субъект РФ',
		'Год'
	];
	
	$arResult['chartsdata']['YEAR'] = array_values(
		array_filter(
			$arResult['chartsdata']['YEAR'], 
			function ($value) {
				return is_numeric($value);
			}
		)
	);
	
	
	
	$arResult['chartsdata']['GROUPS'] = [];
	$arResult['chartsdata']['GROUPS_KEYS'] = [];
	
	$colors = array_values($arResult['chartsdata']['COLORS']);
	array_unique($colors);
	
	foreach ($colors as $color) {
		$groupKeys = array_keys(
			array_filter(
				$arResult['chartsdata']['COLORS'], 
				function ($value) use ($color) {
					return $color == $value;
				}
			)
		);
		
		$arResult['chartsdata']['GROUPS_KEYS'][$color] = $groupKeys;
		
		foreach ($arResult['chartsdata']['YEAR'] as $year) {
			$groupValues = array_filter(
				$arResult['chartsdata']['VALUES'],
				function ($data) use ($year, $groupKeys) {
					return $data[2] == $year && in_array($data[1], $groupKeys);
				}
			);
			
			$groupData = array_column($groupValues, 0);
			
			$arResult['chartsdata']['GROUPS'][$color][] = (array_sum($groupData) / count($groupData));
			/*[
				(array_sum($groupData) / count($groupData)),
				$color,
				$year
			];*/
		}
	}
	
	//dd($arResult['chartsdata']['GROUPS']);
	
	/*foreach ($config['VALUES'] as $key => $data) {
		if (0 === $key || !isset($config['SUBJECTS'][$data[1]])) {
			continue;
		}
		
		$arResult['chartsdata']['data'][] = [
			$data[0],
			$config['SUBJECTS'][$data[1]],
			$data[2]
		];
	}*/
}