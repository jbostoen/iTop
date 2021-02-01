<?php
/**
 * @copyright   Copyright (C) 2010-2020 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Application\UI\Base\Component\Field;


use Combodo\iTop\Application\UI\Base\Layout\UIContentBlock;
use Combodo\iTop\Application\UI\Base\UIBlock;

/**
 * @since 3.0.0
 */
class Field extends UIContentBlock
{
	/** @inheritdoc */
	public const BLOCK_CODE = 'ibo-field';
	/** @inheritdoc */
	public const DEFAULT_HTML_TEMPLATE_REL_PATH = 'base/components/field/layout';

	public const ENUM_FIELD_LAYOUT_SMALL = 'small';
	public const ENUM_FIELD_LAYOUT_LARGE = 'large';

	/** @var string */
	protected $sLayout;
	/** @var string */
	protected $sAttCode;
	/** @var string */
	protected $sAttType;
	/** @var string */
	protected $sAttLabel;
	/** @var bool */
	protected $bIsReadOnly = false;
	/** @var bool */
	protected $bIsMandatory = false;
	/** @var bool */
	protected $bMustChange = false;
	/** @var bool */
	protected $bMustPrompt = false;
	/** @var bool */
	protected $bIsSlave = false;
	/** @var string */
	protected $sValueRaw;
	/** @var string */
	protected $sLabel;
	/** @var string */
	protected $sValueId;

	/** @var string */
	protected $sComments;

	public function __construct(string $sLabel, UIBlock $oValue = null, ?string $sId = null)
	{
		parent::__construct($sId);
		$this->sLabel = $sLabel;
		$this->sValueId = null;
		if (!is_null($oValue)) {
			$this->AddSubBlock($oValue);
		}
	}

	/**
	 * @return string
	 */
	public function GetLayout(): ?string
	{
		return $this->sLayout;
	}

	/**
	 * @param string $sLayout
	 *
	 * @return Field
	 */
	public function SetLayout(string $sLayout)
	{
		$this->sLayout = $sLayout;

		return $this;
	}

	/**
	 * @return string
	 */
	public function GetAttCode(): ?string
	{
		return $this->sAttCode;
	}

	/**
	 * @param string $sAttCode
	 *
	 * @return Field
	 */
	public function SetAttCode(string $sAttCode): Field
	{
		$this->sAttCode = $sAttCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function GetAttType(): ?string
	{
		return $this->sAttType;
	}

	/**
	 * @param string $sAttType
	 *
	 * @return Field
	 */
	public function SetAttType(string $sAttType): Field
	{
		$this->sAttType = $sAttType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function GetAttLabel(): ?string
	{
		return $this->sAttLabel;
	}

	/**
	 * @param string $sAttLabel
	 *
	 * @return Field
	 */
	public function SetAttLabel(string $sAttLabel): Field
	{
		$this->sAttLabel = $sAttLabel;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function IsReadOnly(): bool
	{
		return $this->bIsReadOnly;
	}

	/**
	 * @param bool $bIsReadOnly
	 *
	 * @return Field
	 */
	public function SetIsReadOnly(bool $bIsReadOnly)
	{
		$this->bIsReadOnly = $bIsReadOnly;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function IsMandatory(): bool
	{
		return $this->bIsMandatory;
	}

	/**
	 * @param bool $bIsMandatory
	 *
	 * @return Field
	 */
	public function SetIsMandatory(bool $bIsMandatory)
	{
		$this->bIsMandatory = $bIsMandatory;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function IsMustChange(): bool
	{
		return $this->bMustChange;
	}

	/**
	 * @param bool $bIsMustChange
	 *
	 * @return Field
	 */
	public function SetMustChange(bool $bIsMustChange)
	{
		$this->bMustChange = $bIsMustChange;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function IsMustPrompt(): bool
	{
		return $this->bMustPrompt;
	}

	/**
	 * @param bool $bIsMustPrompt
	 *
	 * @return Field
	 */
	public function SetMustPrompt(bool $bIsMustPrompt)
	{
		$this->bMustPrompt = $bIsMustPrompt;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function IsSlave(): bool
	{
		return $this->bIsSlave;
	}

	/**
	 * @param bool $bIsSlave
	 *
	 * @return Field
	 */
	public function SetIsSlave(bool $bIsSlave)
	{
		$this->bIsSlave = $bIsSlave;

		return $this;
	}

	/**
	 * @return string
	 */
	public function GetValueRaw(): ?string
	{
		return $this->sValueRaw;
	}

	/**
	 * @param string $sValueRaw
	 *
	 * @return Field
	 */
	public function SetValueRaw(string $sValueRaw)
	{
		$this->sValueRaw = $sValueRaw;

		return $this;
	}

	/**
	 * @return string
	 */
	public function GetLabel(): string
	{
		return $this->sLabel;
	}

	/**
	 * @param string $sLabel
	 *
	 * @return Field
	 */
	public function SetLabel(string $sLabel)
	{
		$this->sLabel = $sLabel;

		return $this;
	}

	/**
	 * @return \Combodo\iTop\Application\UI\Base\UIBlock
	 */
	public function GetValue()
	{
		return $this->oValue;
	}

	/**
	 * @param \Combodo\iTop\Application\UI\Base\UIBlock $oValue
	 *
	 * @return Field
	 */
	public function SetValue(UIBlock $oValue)
	{
		$this->oValue = $oValue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function GetComments(): ?string
	{
		return $this->sComments;
	}

	/**
	 * @param string $sComments
	 *
	 * @return Field
	 */
	public function SetComments(string $sComments)
	{
		$this->sComments = $sComments;

		return $this;
	}

	/**
	 * @return string
	 */
	public function GetValueId(): ?string
	{
		return $this->sValueId;
	}

	/**
	 * @param string|null $sValueId
	 *
	 * @return $this
	 */
	public function SetValueId(?string $sValueId)
	{
		$this->sValueId = $sValueId;
		return $this;
	}

}