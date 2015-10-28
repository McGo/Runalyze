<?php
/**
 * This file contains all empty values needed to create a new account.
 *
 * Structure:
 * $EmptyTables['TABLENAME_WITHOUT_PREFIX'] = array('columns' => array(...), 'values' => array( array(...), ... ));
 *
 * @author Hannes Christiansen
 * @package Runalyze\System
 */
$EmptyTables = array();
$EmptyTables['runalyze_equipment_type'] = array(
	'columns' => array('name', 'input'),
	'values'  => array(
		array(__('Shoes'), 0, 'EQUIPMENT_SHOES_ID'),
		array(__('Clothes'), 1, 'EQUIPMENT_CLOTHES_ID')
	)
);

$EmptyTables['dataset'] = array(
	'columns' => array('name', 'modus', 'class', 'style', 'position', 'summary', 'summary_mode'),
	'values'  => array(
		array('time', 1, 'c', '', 1, 0, 'NO'),
		array('weatherid', 2, '', '', 2, 0, 'NO'),
		array('temperature', 2, 'small', 'width:35px;', 3, 0, 'AVG'),
		array('typeid', 2, '', '', 4, 0, 'NO'),
		array('sportid', 3, '', '', 5, 0, 'YES'),
		array('distance', 2, '', '', 6, 1, 'SUM'),
		array('s', 3, '', '', 7, 1, 'SUM'),
		array('pace', 2, 'small', '', 8, 1, 'AVG'),
		array('pulse_avg', 2, 'small', 'font-style:italic;', 9, 1, 'AVG'),
		array('pulse_max', 1, 'small', '', 10, 0, 'MAX'),
		array('elevation', 2, 'small', '', 11, 1, 'SUM'),
		array('kcal', 2, 'small', '', 12, 1, 'SUM'),
		array('splits', 2, '', '', 13, 0, 'NO'),
		array('comment', 2, 'small l', '', 14, 0, 'NO'),
		array('trimp', 2, '', '', 15, 1, 'SUM'),
		array('vdoticon', 2, '', '', 16, 1, 'AVG'),
		array('vdot', 1, '', '', 17, 1, 'AVG'),
		array('abc', 1, '', '', 18, 0, 'NO'),
		array('partner', 1, 'small', '', 21, 0, 'NO'),
		array('routeid', 1, 'small l', '', 22, 0, 'NO'),
		array('cadence', 1, 'small', '', 23, 1, 'AVG'),
		array('power', 1, 'small', '', 24, 1, 'SUM'),
		array('jd_intensity', 2, '', '', 25, 1, 'SUM'),
		array('groundcontact', 2, 'small', '', 26, 1, 'AVG'),
		array('vertical_oscillation', 2, 'small', '', 27, 1, 'AVG'),
		array('stride_length', 1, 'small', '', 28, 1, 'AVG'),
		array('fit_vdot_estimate', 1, 'small', '', 29, 1, 'AVG'),
		array('fit_recovery_time', 1, 'small', '', 30, 1, 'NO'),
		array('fit_hrv_analysis', 1, 'small', '', 31, 1, 'AVG')
	)
);
$EmptyTables['plugin'] = array(
	'columns' => array('key', 'type', 'active', 'order'),
	'values'  => array(
		array('RunalyzePluginPanel_Sports', 'panel', 1, 1),
		array('RunalyzePluginPanel_Rechenspiele', 'panel', 1, 2),
		array('RunalyzePluginPanel_Prognose', 'panel', 2, 3),
		array('RunalyzePluginPanel_Equipment', 'panel', 2, 4),
		array('RunalyzePluginPanel_Sportler', 'panel', 1, 5),
		array('RunalyzePluginStat_Analyse', 'stat', 1, 2),
		array('RunalyzePluginStat_Statistiken', 'stat',1, 1),
		array('RunalyzePluginStat_Wettkampf', 'stat', 1, 3),
		array('RunalyzePluginStat_Wetter', 'stat', 1, 5),
		array('RunalyzePluginStat_Rekorde', 'stat', 2, 6),
		array('RunalyzePluginStat_Strecken', 'stat', 2, 7),
		array('RunalyzePluginStat_Trainingszeiten', 'stat', 2, 8),
		array('RunalyzePluginStat_Trainingspartner', 'stat', 2, 9),
		array('RunalyzePluginStat_Hoehenmeter', 'stat', 2, 10),
		array('RunalyzePluginStat_Laufabc', 'stat', 1, 11),
		array('RunalyzePluginTool_Cacheclean', 'tool', 1, 99),
		array('RunalyzePluginTool_DatenbankCleanup', 'tool', 1, 99),
		array('RunalyzePluginTool_MultiEditor', 'tool', 1, 99),
		array('RunalyzePluginTool_AnalyzeVDOT', 'tool', 1, 99),
		array('RunalyzePluginTool_DbBackup', 'tool', 1, 99),
		array('RunalyzePluginTool_JDTables', 'tool', 1, 99),
		array('RunalyzePluginPanel_Ziele', 'panel', 0, 6)
	)
);
$EmptyTables['sport'] = array(
	'columns' => array('name', 'img', 'short', 'kcal', 'HFavg', 'distances', 'speed', 'power', 'outside'),
	'values'  => array(
		array(__('Running'), 'icons8-running', 0, 880, 140, 1, "min/km", 0, 1, 'RUNNING_SPORT_ID', 'MAIN_SPORT_ID'),
		array(__('Swimming'), 'icons8-swimming', 0, 743, 130, 1, "min/100m", 0, 0),
		array(__('Biking'), 'icons8-regular_biking', 0, 770, 120, 1, "km/h", 1, 1),
		array(__('Gymnastics'), 'icons8-yoga', 1, 280, 100, 0, "km/h", 0, 0),
		array(__('Other'), 'icons8-sports_mode', 0, 500, 120, 0, "km/h", 0, 0)
	)
);
$EmptyTables['type'] = array(
	// Sportid will be updated by AccountHandler::setSpecialConfigValuesFor
	'columns' => array('name', 'abbr', 'hr_avg', 'quality_session'),
	'values'  => array(
		array(__('Jogging'), __('JOG'), 143, 0),
		array(__('Fartlek'), __('FL'), 150, 1),
		array(__('Interval training'), __('IT'), 165, 1),
		array(__('Tempo Run'), __('TR'), 165, 1),
		array(__('Race'), __('RC'), 190, 1, 'TYPE_ID_RACE'),
		array(__('Regeneration Run'), __('RG'), 128, 0),
		array(__('Long Slow Distance'), __('LSD'), 150, 1),
		array(__('Warm-up'), __('WU'), 128, 0)
	)
);
