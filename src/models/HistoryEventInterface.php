<?php
declare(strict_types = 1);

namespace pozitronik\arlogger\models;

use app\modules\users\models\Users;

/**
 * Interface HistoryEventInterface
 *
 * @property int $eventType Что сделал
 * @property null|string $eventTypeName Что сделал
 * @property string|null $eventIcon Иконка?
 * @property string $eventTime Во сколько сделал
 * @property string $objectName Где сделал
 * @property null|Users $subject Кто сделал
 * @property HistoryEventAction[] $actions Что произошло
 * @property null|string $eventCaption Переопределить типовой заголовок события
 *
 * @property TimelineEntry $timelineEntry
 */
interface HistoryEventInterface {
	public const EVENT_CREATED = 0;
	public const EVENT_CHANGED = 1;
	public const EVENT_DELETED = 2;

	public const EVENT_TYPE_NAMES = [
		self::EVENT_CREATED => 'Запись добавлена',
		self::EVENT_CHANGED => 'Запись изменена',
		self::EVENT_DELETED => 'Запись удалена'
	];

}