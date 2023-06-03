<?php
class TestFeedbackCorrectFieldsCest
{
	// XXX: Creation test with valid value of field matricula 1° option. { /*Y:1020*/ }
	public function FeedbackCorrectMatriculaInUniqueData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the matricula field in the unique rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '1020', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->seeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '1020', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with valid value of field cpf 2° option. { /*Y:000000111-00*/ }
	public function FeedbackCorrectCpfInCpfData2(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the cpf field in the cpf rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000000111-00', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->seeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000000111-00', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with valid value of field cpf 2° option. { /*Y:0000000082*/ }
	public function FeedbackCorrectCpfInRequiredData2(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the cpf field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '0000000082', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->seeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '0000000082', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with valid value of field matricula 2° option. { /*Y:0088*/ }
	public function FeedbackCorrectMatriculaInRequiredData2(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the matricula field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '0088', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->seeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '0088', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with valid value of field nome 2° option. { /*Y:Kaio Allan*/ }
	public function FeedbackCorrectNomeInRequiredData2(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the nome field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Kaio Allan', 
		]);
		$I->seeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '8988', 
			'nome' => 'Kaio Allan', 
		]);
	}

}