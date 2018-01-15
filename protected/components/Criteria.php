<?php

class Criteria extends CDbCriteria {

	public function setInUserStaff() {

		$userLevelStage = Yii::app() -> session['userLevelStage'];

		if ($userLevelStage != 1) {
			$userStaff = Yii::app() -> session['userStaff'];
			$this -> addInCondition('t.userID', $userStaff);
		}

	}

}
