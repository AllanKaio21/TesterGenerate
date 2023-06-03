<?php
class TestFeedbackDeleteCest
{
	// XXX: Field deletion test matricula with data in 1° position. { /*Y:1020*/ }
	public function FeedbackDeleteMatriculaInUniqueData1(FunctionalTester $I)
	{
		$I->wantTo('Verify exception for delete');
		$model = $I->grabRecord('app\models\Feedback', array('matricula' => '1020'));
		// TODO: Change the attribute name 'id' to the first key of the table if necessary.
		$id = $model->id;
		$I->amOnRoute('/feedback/delete', ['id' => $id]);
		$I->dontSeeRecord('app\models\Feedback', ['id' => $id]);
	}

	// XXX: Field deletion test cpf with data in 2° position. { /*Y:000000111-00*/ }
	public function FeedbackDeleteCpfInCpfData2(FunctionalTester $I)
	{
		$I->wantTo('Verify exception for delete');
		$model = $I->grabRecord('app\models\Feedback', array('cpf' => '000000111-00'));
		// TODO: Change the attribute name 'id' to the first key of the table if necessary.
		$id = $model->id;
		$I->amOnRoute('/feedback/delete', ['id' => $id]);
		$I->dontSeeRecord('app\models\Feedback', ['id' => $id]);
	}

	// XXX: Field deletion test cpf with data in 2° position. { /*Y:0000000082*/ }
	public function FeedbackDeleteCpfInRequiredData2(FunctionalTester $I)
	{
		$I->wantTo('Verify exception for delete');
		$model = $I->grabRecord('app\models\Feedback', array('cpf' => '0000000082'));
		// TODO: Change the attribute name 'id' to the first key of the table if necessary.
		$id = $model->id;
		$I->amOnRoute('/feedback/delete', ['id' => $id]);
		$I->dontSeeRecord('app\models\Feedback', ['id' => $id]);
	}

	// XXX: Field deletion test matricula with data in 2° position. { /*Y:0088*/ }
	public function FeedbackDeleteMatriculaInRequiredData2(FunctionalTester $I)
	{
		$I->wantTo('Verify exception for delete');
		$model = $I->grabRecord('app\models\Feedback', array('matricula' => '0088'));
		// TODO: Change the attribute name 'id' to the first key of the table if necessary.
		$id = $model->id;
		$I->amOnRoute('/feedback/delete', ['id' => $id]);
		$I->dontSeeRecord('app\models\Feedback', ['id' => $id]);
	}

	// XXX: Field deletion test nome with data in 2° position. { /*Y:Kaio Allan*/ }
	public function FeedbackDeleteNomeInRequiredData2(FunctionalTester $I)
	{
		$I->wantTo('Verify exception for delete');
		$model = $I->grabRecord('app\models\Feedback', array('nome' => 'Kaio Allan'));
		// TODO: Change the attribute name 'id' to the first key of the table if necessary.
		$id = $model->id;
		$I->amOnRoute('/feedback/delete', ['id' => $id]);
		$I->dontSeeRecord('app\models\Feedback', ['id' => $id]);
	}

}