<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

return array(
	'ctrl' => array(
		'title' => 'Products',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_product.png',
		'external' => array(
			0 => array(
				'connector' => 'feed',
				'parameters' => array(
					'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Products.xml',
					'encoding' => 'utf8'
				),
				'data' => 'xml',
				'nodetype' => 'products',
				'reference_uid' => 'sku',
				'priority' => 5100,
				'description' => 'Products catalogue'
			)
		)
	),
	'interface' => array(
		'showRecordFieldList' => 'sku,name'
	),
	'columns' => array(
		'sku' => array(
			'exclude' => 0,
			'label' => 'SKU',
			'config' => array(
				'type' => 'input',
				'size' => '10'
			),
			'external' => array(
				0 => array(
					'xpath' => './self::*[@type="current"]/item',
					'attribute' => 'sku'
				)
			)
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'Name',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
			'external' => array(
				0 => array(
					'xpath' => './self::*[@type="current"]/item',
				)
			)
		),
		'tags' => array(
			'exclude' => 0,
			'label' => 'Tags',
			'config' => array(
				'type' => 'select',
				'size' => '5',
				'foreign_table' => 'tx_externalimporttest_tag',
				'foreign_table_where' => 'ORDER BY name',
				'minitems' => 0,
				'maxitems' => 9999
			),
			'external' => array(
				0 => array(
					'xpath' => './self::*[@type="current"]/tags',
					'mapping' => array(
						'table' => 'tx_externalimporttest_tag',
						'reference_field' => 'code',
						'multipleValuesSeparator' => ','
					)
				)
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => 'name,sku,tags')
	),
);
