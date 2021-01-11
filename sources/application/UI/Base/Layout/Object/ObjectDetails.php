<?php
/*
 * @copyright   Copyright (C) 2010-2020 Combodo SARL
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace Combodo\iTop\Application\UI\Base\Layout\Object;


use cmdbAbstractObject;
use Combodo\iTop\Application\UI\Base\Component\Panel\Panel;
use Combodo\iTop\Application\UI\Helper\UIHelper;
use DBObject;
use MetaModel;

class ObjectDetails extends Panel
{
	// Overloaded constants
	public const BLOCK_CODE = 'ibo-object-details';
	public const DEFAULT_HTML_TEMPLATE_REL_PATH = 'base/layouts/object/object-details/layout';

	/** @var string Class name of the object (eg. "UserRequest") */
	protected $sClassName;
	/** @var string Class label of the object (eg. "User request") */
	protected $sClassLabel;
	/** @var string ID of the object */
	protected $sObjectId;
	/** @var string */
	protected $sObjectName;
	/**
	 * @var string The mode in which the object should be displayed (read, edit, create, ...)
	 * @see \cmdbAbstractObject::ENUM_OBJECT_MODE_XXX
	 */
	protected $sObjectMode;
	/** @var string */
	protected $sIconUrl;
	/** @var string */
	protected $sStatusCode;
	/** @var string */
	protected $sStatusLabel;
	/** @var string */
	protected $sStatusColor;

	/**
	 * ObjectDetails constructor.
	 *
	 * @param \DBObject   $oObject  The object for which we display the details
	 * @param string $sMode         See \cmdbAbstractObject::ENUM_OBJECT_MODE_XXX
	 * @param string|null $sId      ID of the block itself, not the $oObject ID
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function __construct(DBObject $oObject, string $sMode = cmdbAbstractObject::DEFAULT_OBJECT_MODE, ?string $sId = null) {
		$this->sClassName = get_class($oObject);
		$this->sClassLabel = MetaModel::GetName($this->GetClassName());
		$this->sObjectId = $oObject->GetKey();
		// Note: We get the raw name as only the front-end consumer knows when and how to encode it.
		$this->sObjectName = $oObject->GetRawName();
		$this->sObjectMode = $sMode;
		$this->sIconUrl = $oObject->GetIcon(false);

		if(MetaModel::HasStateAttributeCode($this->sClassName)) {
			$this->sStatusCode = $oObject->GetState();
			$this->sStatusLabel = $oObject->GetStateLabel();
			$this->sStatusColor = UIHelper::GetColorFromStatus($this->sClassName, $this->sStatusCode);
		}

		parent::__construct('', [], static::DEFAULT_COLOR, $sId);
	}

	/**
	 * @see self::$sClassName
	 * @return string
	 */
	public function GetClassName(): string
	{
		return $this->sClassName;
	}

	/**
	 * @see self::$sClassLabel
	 * @return string
	 */
	public function GetClassLabel(): string
	{
		return $this->sClassLabel;
	}

	/**
	 * @see self::$sObjectName
	 * @return string
	 */
	public function GetObjectName(): string
	{
		return $this->sObjectName;
	}

	/**
	 * @see self::$sObjectId
	 * @return string
	 */
	public function GetObjectId(): string
	{
		return $this->sObjectId;
	}

	/**
	 * @see self::$sObjectMode
	 * @return string
	 */
	public function GetObjectMode(): string
	{
		return $this->sObjectMode;
	}

	/**
	 * Set the status to display for the object
	 *
	 * @param string $sCode
	 * @param string $sLabel
	 * @param string $sColor
	 *
	 * @return $this
	 */
	public function SetStatus(string $sCode, string $sLabel, string $sColor)
	{
		$this->sStatusCode = $sColor;
		$this->sStatusLabel = $sLabel;
		$this->sStatusColor = $sColor;

		return $this;
	}

	/**
	 * @see self::$sStatusCode
	 * @return string
	 */
	public function GetStatusCode(): string
	{
		return $this->sStatusCode;
	}

	/**
	 * @see self::$sStatusLabel
	 * @return string
	 */
	public function GetStatusLabel(): string
	{
		return $this->sStatusLabel;
	}

	/**
	 * @see self::$sStatusColor
	 * @return string
	 */
	public function GetStatusColor(): string
	{
		return $this->sStatusColor;
	}
}