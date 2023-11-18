<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header('Location: login.php');
  exit();
}

// Sample questions array with correct answers and scores
$questions = array(
  array(
    'question' => 'What sort of animal is Walt Disney\'s Dumbo?',
    'options' => array('Deer', 'Rabbit', 'Elephant', 'Donkey'),
    'correct_option' => 'Elephant',
    'score' => 100
  ),
  array(
    'question' => 'What was the name of the Spanish waiter in the TV sitcom "Fawlty Towers"?',
    'options' => array('Manuel', 'Pedro', 'Alfonso', 'Javier'),
    'correct_option' => 'Manuel',
    'score' => 200
  ),
  array(
    'question' => 'Which battles took place between the Royal Houses of York and Lancaster?',
    'options' => array('Thirty Years War', 'Hundred Years War', 'Wars of the Roses', 'English Civil War'),
    'correct_option' => 'Wars of the Roses',
    'score' => 300
  ),
  array(
    'question' => 'Which former Beatle narrated the TV adventures of Thomas the Tank Engine?',
    'options' => array('John Lennon', 'Paul McCartney', 'George Harrison', 'Ringo Starr'),
    'correct_option' => 'Ringo Starr',
    'score' => 500
  ),
  array(
    'question' => 'Queen Anne was the daughter of which English Monarch?',
    'options' => array('James II', 'Henry VIII', 'Victoria', 'William I'),
    'correct_option' => 'James II',
    'score' => 1000
  ),
  array(
    'question' => 'Who composed "Rhapsody in Blue"?',
    'options' => array('Irving Berlin', 'George Gershwin', 'Aaron Copland', 'Cole Porter'),
    'correct_option' => 'George Gershwin',
    'score' => 2000
  ),
  array(
    'question' => 'What is the Celsius equivalent of 77 degrees Fahrenheit?',
    'options' => array('15', '20', '25', '30'),
    'correct_option' => '25',
    'score' => 4000
  ),
  array(
    'question' => 'What are Suffolk Punch and Hackney?',
    'options' => array('Carriage', 'Wrestling style', 'Cocktail', 'Horse'),
    'correct_option' => 'Horse',
    'score' => 8000
  ),
  array(
    'question' => 'Which Shakespeare play features the line "Neither a borrower nor a lender be"?',
    'options' => array('Hamlet', 'Macbeth', 'Othello', 'The Merchant of Venice'),
    'correct_option' => 'Hamlet',
    'score' => 16000
  ),
  array(
    'question' => 'Which is the largest city in the USA\'s largest state?',
    'options' => array('Dallas', 'Los Angeles', 'New York', 'Anchorage'),
    'correct_option' => 'Anchorage',
    'score' => 32000
  ),
  array(
    'question' => 'The word "aristocracy" literally means power in the hands of?',
    'options' => array('The few', 'The best', 'The barons', 'The rich'),
    'correct_option' => 'The best',
    'score' => 64000
  ),
  array(
    'question' => 'Where would a "peruke" be worn?',
    'options' => array('Around the neck', 'On the head', 'Around the waist', 'On the wrist'),
    'correct_option' => 'On the head',
    'score' => 125000
  ),
  array(
    'question' => 'In which palace was Queen Elizabeth I born?',
    'options' => array('Greenwich', 'Richmond', 'Hampton Court', 'Kensington'),
    'correct_option' => 'Greenwich',
    'score' => 250000
  ),
  array(
    'question' => 'From which author\'s work did scientists take the word "quark"??',
    'options' => array('Lewis Carroll', 'Edward Lear', 'James Joyce', 'Aldous Huxley'),
    'correct_option' => 'James Joyce',
    'score' => 500000
  ),
  array(
    'question' => 'Which of these islands was ruled by Britain from 1815 until 1864?',
    'options' => array('Crete', 'Cyprus', 'Corsica', 'Corfu'),
    'correct_option' => 'Corfu',
    'score' => 1000000
  )
);

// Function to get the next question index
function getNextQuestionIndex($currentQuestionIndex) {
  return $currentQuestionIndex + 1;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_option'])) {
  $selectedOption = $_POST['selected_option'];
  $currentQuestionIndex = $_SESSION['current_question'];

// Check if the selected option is correct for the current question
  if ($questions[$currentQuestionIndex]['correct_option'] === $selectedOption) {
// If correct, add the score to the total
    $_SESSION['total_score'] = $questions[$currentQuestionIndex]['score'];

// Redirect to the next question or set quiz as completed
    $_SESSION['current_question'] = getNextQuestionIndex($currentQuestionIndex);
    if ($_SESSION['current_question'] == count($questions)) {
      $_SESSION['quiz_completed'] = true;
    }
    header("Location: quiz.php");
    exit();
  } else {
    if($currentQuestionIndex>=5 && $currentQuestionIndex<=9)
      $_SESSION['total_score']=1000;
    else if($currentQuestionIndex>9 && $currentQuestionIndex<14)
      $_SESSION['total_score']=32000;
    $_SESSION['quiz_completed'] = true;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quit'])) {
  $_SESSION['quiz_completed'] = true;
  $_SESSION['quit'] = true;
}

// Initialize the session variables
if (!isset($_SESSION['current_question'])) {
  $_SESSION['current_question'] = 0;
}

if (!isset($_SESSION['total_score'])) {
  $_SESSION['total_score'] = 0;
}

function displayQuestion() {
  global $questions;
  $currentQuestionIndex = $_SESSION['current_question'];
  $totalQuestions = count($questions);

  echo '<div id="content">Please Note that you can <span style="color:red;"> QUIT </span> any time and You\'ll earn the amount won till now.</div>';

  if((!isset($_SESSION['quiz_completed']) || $_SESSION['quiz_completed'] !== true) && ($currentQuestionIndex>=5 && $currentQuestionIndex<=9)){
    echo '<div class="quiz-container">'; 
    echo '<div class="score"> Congratulations, You reached first safe heaven.</div>';
    echo '<div class="score" style="color:red;">You\'re total amount earned will be $1000 even if you miss next questions.</div>';
    echo '</div>';
  }
  else if((!isset($_SESSION['quiz_completed']) || $_SESSION['quiz_completed'] !== true) && ($currentQuestionIndex>9 && $currentQuestionIndex<14)){
    echo '<div class="quiz-container">'; 
    echo '<div class="score"> Congratulations, You reached second safe heaven.</div>';
    echo '<div class="score" style="color:red;">You\'re total amount earned will be $32000 even if you miss next questions.</div>';
    echo '</div>';
  }
  else if((!isset($_SESSION['quiz_completed']) || $_SESSION['quiz_completed'] !== true) && $currentQuestionIndex==14){
    echo '<div class="quiz-container">'; 
    echo '<div class="score"> Congratulations, You made your way to the last question</div>';
    echo '<div class="score" style="color:red;">Answer this question correctly to earn $1,000,000</div>';
    echo '</div>';
  }
  echo '<div class="quiz-container">';   
  if (!isset($_SESSION['quiz_completed']) || $_SESSION['quiz_completed'] !== true) {
    if ($currentQuestionIndex < $totalQuestions) {
// Display the current question
      $question = $questions[$currentQuestionIndex]['question'];
      $options = $questions[$currentQuestionIndex]['options'];
      $currentScore = $_SESSION['total_score'];

      echo '<div class="score"> Question: ' . ($currentQuestionIndex + 1) . ' | Amount earned: $' . $currentScore . '</div>';
      echo '<form method="post" action="quiz.php">';
      echo '<div class="question">' . $question . '</div>';
      echo '<div class="options-container">';
      $rowCount = 2;
      $colCount = count($options) / $rowCount;

      for ($i = 0; $i < $rowCount; $i++) {
        echo '<div class="options-row">';
        for ($j = 0; $j < $colCount; $j++) {
          $index = $i * $colCount + $j;
          $option = $options[$index];
          echo '<div class="option">';
          echo '<input type="radio" name="selected_option" value="' . $option . '" id="option_' . $option . '" hidden>';
          echo '<label for="option_' . $option . '">' . $option . '</label>';
          echo '</div>';
        }
        echo '</div>';
      }
      echo '</div>';
      echo '<div class="button-container">';
      echo '<button type="submit" class="submit-btn">Submit Answer</button>';
      echo '<button type="submit" name="quit" class="quit-btn">Quit</button>';
      echo '</div>';
      echo '</form>';
    }
  } else {
    updateScoreToFile($_SESSION["username"], $_SESSION['total_score']);  
    if ($_SESSION['total_score'] == end($questions)['score']) {
      echo '<div class="score"><strong>Congratulations!</strong></div>';
      echo '<div class="score">You answered all questions correctly and completed the quiz!.</div>';
    } 
    else if($_SESSION['quit']===true){
      echo '<div class="score"><strong>You Quit!</strong></div>';
      echo '<div class="score">You answered all questions correctly till now.</div>';
    }
    else {
      echo '<div class="score"><strong>OOPS!</strong></div>';
      echo '<div class="score">That\'s not the correct answer. The correct answer is: ' . $questions[$currentQuestionIndex]['correct_option'] . '</div>';
      echo '<div class="score">Better luck next time!</div>';
    }
    echo '<div class="score" style="color:red;">Total Amount Earned: $' . $_SESSION['total_score'] . '</div>';
  }
  echo '</div>';
}

function updateScoreToFile($username, $newScore) {
// Read existing user data from file
  $userDataFile = 'user_data.txt';
  $users = file($userDataFile, FILE_IGNORE_NEW_LINES);

// Find the user in the array
  foreach ($users as &$user) {
    $userData = explode(',', $user);
    $currentUsername = trim($userData[0]);

    if ($currentUsername === $username) {
// Update the score for the matching user
      $userData[2] = $newScore;
      $user = implode(',', $userData);
      break;
    }
  }
  file_put_contents($userDataFile, implode(PHP_EOL, $users));
}

?>

<?php include("header.php"); ?>
<?php displayQuestion(); ?>
<?php include("footer.html"); ?>
