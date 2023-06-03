if vendor/bin/codecept run  tests/Feedback/TestFeedbackCorrectFields.php::FeedbackCorrectMatriculaInUniqueData1 --steps; then
	vendor/bin/codecept run  tests/Feedback/TestFeedbackDelete.php::FeedbackDeleteMatriculaInUniqueData1 --steps
fi
if vendor/bin/codecept run  tests/Feedback/TestFeedbackCorrectFields.php::FeedbackCorrectCpfInCpfData1 --steps; then
	vendor/bin/codecept run  tests/Feedback/TestFeedbackDelete.php::FeedbackDeleteCpfInCpfData1 --steps
fi
if vendor/bin/codecept run  tests/Feedback/TestFeedbackCorrectFields.php::FeedbackCorrectCpfInRequiredData1 --steps; then
	vendor/bin/codecept run  tests/Feedback/TestFeedbackDelete.php::FeedbackDeleteCpfInRequiredData1 --steps
fi
if vendor/bin/codecept run  tests/Feedback/TestFeedbackCorrectFields.php::FeedbackCorrectMatriculaInRequiredData1 --steps; then
	vendor/bin/codecept run  tests/Feedback/TestFeedbackDelete.php::FeedbackDeleteMatriculaInRequiredData1 --steps
fi
if vendor/bin/codecept run  tests/Feedback/TestFeedbackCorrectFields.php::FeedbackCorrectNomeInRequiredData1 --steps; then
	vendor/bin/codecept run  tests/Feedback/TestFeedbackDelete.php::FeedbackDeleteNomeInRequiredData1 --steps
fi

if vendor/bin/codecept run  tests/Feedback/TestFeedbackIncorrectFields.php --steps; then
	echo -n 'Testes executados com sucesso!'
fi