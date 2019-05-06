<?php
declare(strict_types = 1);

namespace pozitronik\arlogger\models;

use Throwable;
use yii\data\ActiveDataProvider;

/**
 * Class ActiveRecordLoggerSearch
 * @package pozitronik\arlogger\models
 *
 */
class ActiveRecordLoggerSearch extends ActiveRecordLogger {
	public $actions;
	public $username;

	/**
	 * {@inheritDoc}
	 */
	public function rules():array {
		return [
			[['actions', 'username', 'at', 'model'], 'safe']
		];
	}

	/**
	 * @param array $params
	 * @param bool $pagination
	 * @return ActiveDataProvider
	 * @throws Throwable
	 */
	public function search(array $params, $pagination = true):ActiveDataProvider {
		$query = ActiveRecordLogger::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query
		]);

		$dataProvider->setSort([
			'defaultOrder' => ['id' => SORT_DESC],
			'attributes' => [
				'id',
				'at',
				'relUser',
				'modelKey',
				'model'
			]
		]);

		$this->load($params);
		if (false === $pagination) $dataProvider->pagination = $pagination;

		if (!$this->validate()) return $dataProvider;

		$query->joinWith(['relUser']);
		$query->andFilterWhere(['like', 'sys_users.username', $this->username]);
		$query->andFilterWhere(['in', 'model', $this->model]);

		return $dataProvider;
	}

}