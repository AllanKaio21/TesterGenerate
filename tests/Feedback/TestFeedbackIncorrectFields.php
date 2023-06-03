<?php
class TestFeedbackIncorrectFieldsCest
{
	public function FeedbackinCorrectMatriculaInUniqueData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the matricula field in the unique rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '0088', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '0088', 
			'nome' => 'Allan Kaio', 
		]);
	}

	public function FeedbackinCorrectMatriculaInUniqueData2(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the matricula field in the unique rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

	public function FeedbackinCorrectCpfInCpfData2(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the cpf field in the cpf rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.111.222.22', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.111.222.22', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

}