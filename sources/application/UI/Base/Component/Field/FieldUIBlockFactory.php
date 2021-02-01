<?php
/**
 * @copyright   Copyright (C) 2010-2020 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Application\UI\Base\Component\Field;


use Combodo\iTop\Application\UI\Base\AbstractUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Html\Html;
use Combodo\iTop\Application\UI\Base\UIBlock;

/**
 * @since 3.0.0
 */
class FieldUIBlockFactory extends AbstractUIBlockFactory
{
	public const TWIG_TAG_NAME = 'UIField';
	public const UI_BLOCK_CLASS_NAME = Field::class;

	public static function MakeFromParams($aParams)
	{
		$oValue = new Html($aParams['value']);
		$oField = new Field($aParams['label'], $oValue);

		$aParamsMapping = [
			'layout' => 'SetLayout',
			'attcode' => 'SetAttCode',
			'atttype' => 'SetAttType',
			'attlabel' => 'SetAttLabel',
			'value_raw' => 'SetValueRaw',
			'comments' => 'SetComments',
		];
		foreach ($aParamsMapping as $sParamKey => $sFieldMethod) {
			self::UpdateFieldFromParams($oField, $sFieldMethod, $aParams, $sParamKey);
		}

		if (isset($aParams['attflags'])) {
			$aParamsFlagsMapping = [
				OPT_ATT_HIDDEN => 'SetIsHidden',
				OPT_ATT_READONLY => 'SetIsReadOnly',
				OPT_ATT_MANDATORY => 'SetIsMandatory',
				OPT_ATT_MUSTCHANGE => 'SetMustChange',
				OPT_ATT_MUSTPROMPT => 'SetMustPrompt',
				OPT_ATT_SLAVE => 'SetIsSlave',
			];
			foreach ($aParamsFlagsMapping as $sConstant => $sFieldMethod) {
				self::UpdateFlagsFieldFromParams($oField, $sFieldMethod, $aParams['attflags'], $sConstant);
			}
		}

		return $oField;
	}

	private static function UpdateFieldFromParams($oField, $sMethodName, $aParams, $sKey): void
	{
		if (isset($aParams[$sKey])) {
			$oField->$sMethodName($aParams[$sKey]);
		}
	}

	private static function UpdateFlagsFieldFromParams($oField, $sMethodName, $iParamsFlags, $iConstant): void
	{
		$oField->$sMethodName((($iParamsFlags & $iConstant) === $iConstant));
	}

	public static function MakeFromObject(string $sLabel, UIBlock $oInput, ?string $sLayout = null)
	{
		$oField = new Field($sLabel, $oInput);

		if (!is_null($sLayout)) {
			$oField->SetLayout($sLayout);
		}

		return $oField;
	}

	public static function MakeLarge(string $sLabel, string $sValueHtml = '')
	{
		$oField = new Field($sLabel, new Html($sValueHtml));
		$oField->SetLayout(Field::ENUM_FIELD_LAYOUT_LARGE);
		return $oField;
	}

	public static function MakeSmall(string $sLabel, string $sValueHtml = '')
	{
		$oField = new Field($sLabel, new Html($sValueHtml));
		$oField->SetLayout(Field::ENUM_FIELD_LAYOUT_SMALL);
		return $oField;
	}

	public static function MakeStandard(string $sLabel = '', string $sLayout = Field::ENUM_FIELD_LAYOUT_SMALL, ?string $sId = null)
	{
		$oField = new Field($sLabel, null, $sId);
		$oField->SetLayout($sLayout);
		return $oField;

	}
}