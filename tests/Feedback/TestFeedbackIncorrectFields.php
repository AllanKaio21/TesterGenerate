<?php
class TestFeedbackIncorrectFieldsCest
{
	// XXX: Creation test with invalid value of field matricula 1° option. { /*N:0088*/ }
	public function FeedbackInCorrectMatriculaInUniqueData1(FunctionalTester $I)
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

	// XXX: Creation test with invalid value of field matricula 2° option. { /*N:8988*/ }
	public function FeedbackInCorrectMatriculaInUniqueData2(FunctionalTester $I)
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

	// XXX: Creation test with invalid value of field cpf 1° option. { /*N:000-111-222-22*/ }
	public function FeedbackInCorrectCpfInCpfData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the cpf field in the cpf rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000-111-222-22', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000-111-222-22', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with invalid value of field cpf 2° option. { /*N:000.111.222.22*/ }
	public function FeedbackInCorrectCpfInCpfData2(FunctionalTester $I)
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

	// XXX: Creation test with invalid value of field datanasc 1° option. { /*N:2002/10/10*/ }
	public function FeedbackInCorrectDatanascInDateData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the datanasc field in the date rule');
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

	// XXX: Creation test with invalid value of field id_curso 1° option. { /*N:*/ }
	public function FeedbackInCorrectId_cursoInRequiredData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the id_curso field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with invalid value of field email 1° option. { /*N:*/ }
	public function FeedbackInCorrectEmailInRequiredData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the email field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => '', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => '', 
			'cpf' => '000.000.000-22', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with invalid value of field cpf 1° option. { /*N:*/ }
	public function FeedbackInCorrectCpfInRequiredData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the cpf field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '', 
			'matricula' => '8988', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with invalid value of field matricula 1° option. { /*N:*/ }
	public function FeedbackInCorrectMatriculaInRequiredData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the matricula field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '', 
			'Feedback[nome]' => 'Allan Kaio', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '', 
			'nome' => 'Allan Kaio', 
		]);
	}

	// XXX: Creation test with invalid value of field nome 1° option. { /*N:*/ }
	public function FeedbackInCorrectNomeInRequiredData1(FunctionalTester $I)
	{
		$I->wantTo('The registration occurs correctly for the nome field in the required rule');
		$I->amOnRoute('feedback/create');
		$I->submitForm('form',[
			'Feedback[id_curso]' => '23', 
			'Feedback[email]' => 'allan@gmail.com', 
			'Feedback[cpf]' => '000.000.000-22', 
			'Feedback[matricula]' => '8988', 
			'Feedback[nome]' => '', 
		]);
		$I->dontSeeRecord('app\models\Feedback', [
			'id_curso' => '23', 
			'email' => 'allan@gmail.com', 
			'cpf' => '000.000.000-22', 
			'matricula' => '8988', 
			'nome' => '', 
		]);
	}

}