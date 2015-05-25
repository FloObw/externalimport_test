<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/**
 * Import of product into pages is used to test the creation of pages,
 * in particular the reverse order that must be applied.
 */
$newColumn = array(
	'product_sku' => array(
		'label' => 'Product SKU',
		'config' => array(
			'type' => 'input'
		),
		'external' => array(
			'product_pages' => array(
				'field' => 'sku'
			)
		)
	)
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $newColumn);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'product_sku');

$GLOBALS['TCA']['pages']['ctrl']['external']['product_pages'] = array(
	'connector' => 'csv',
	'parameters' => array(
		'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/ProductPages.csv',
		'delimiter' => ';',
		'text_qualifier' => '',
		'encoding' => 'utf8',
		'skip_rows' => 1
	),
	'data' => 'array',
	'reference_uid' => 'product_sku',
	'priority' => 6000,
	'description' => 'Product pages'
);
$GLOBALS['TCA']['pages']['columns']['title']['external']['product_pages'] = array(
	'field' => 'name'
);