<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic 8-Ball</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Function to toggle play/pause from audio
        function toggleMusic() {
            var audio = document.getElementById("bg-music");
            var musicButton = document.getElementById("music-btn");

            // Check if the audio is paused or playing
            if (audio.paused) {
                audio.play();  // Play the audio
                musicButton.innerHTML = "Pause Music";  // Change button text to "Pause Music"
            } else {
                audio.pause();  // Pause the audio
                musicButton.innerHTML = "Play Music";  // Change button text to "Play Music"
            }
        }

        // Ensure the button text is updated based on the audio state when the page loads
        window.onload = function() {
            var audio = document.getElementById("bg-music");
            var musicButton = document.getElementById("music-btn");

            if (!audio.paused) {
                musicButton.innerHTML = "Pause Music";  // Music is autoplaying when the page is loaded, so show "Pause Music"
            } else {
                musicButton.innerHTML = "Play Music";  // Music is paused initially
            }
        };
    </script>
</head>
<body>

    <!-- Navbar with English, Japanese and Music Button links-->
    <nav>
    <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">English</a>
    <a href="indexjp.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'indexjp.php' ? 'active' : ''; ?>">日本語</a>
    <button id="music-btn" onclick="toggleMusic()">Pause Music</button>
</nav>


    <div class="container">
        <h1>Magic 8-Ball</h1>
        <img src="https://i.imgur.com/eU3li2h.png" alt="8ball">
        <p>I can see the future... Ask me anything if you dare!</p>
        
        <form method="POST">
            <input type="text" name="question" placeholder="Ask your question here..." required>
            <input type="submit" value="Ask the Magic 8-Ball">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question'])) {
            function magic8Ball($question) {
                echo "<div class='question'>So you asked me: $question</div>";
                echo "<div class='message'>Give me a second... I will answer your question.</div>";

                // Generates a random number from 0 and 19
                $randomNumber = rand(0, 19);
                echo "<div class='randomNumber'>Your magic number is: $randomNumber</div>";

                // Switch case based on the random number
                switch ($randomNumber) {
                    case 0:
                        echo "<div class='answer'>It is certain.</div>";
                        break;
                    case 1:
                        echo "<div class='answer'>It is decidedly so.</div>";
                        break;
                    case 2:
                        echo "<div class='answer'>Without a doubt.</div>";
                        break;
                    case 3:
                        echo "<div class='answer'>Yes - definitely.</div>";
                        break;
                    case 4:
                        echo "<div class='answer'>You may rely on it.</div>";
                        break;
                    case 5:
                        echo "<div class='answer'>As I see it, yes.</div>";
                        break;
                    case 6:
                        echo "<div class='answer'>Most likely.</div>";
                        break;
                    default:
                        echo "<div class='answer'>I can see no other future for you.</div>";
                }
                echo "<div class='message'>Will you ask another question?</div>";
            }

            // Get the question from the form submission
            $question = htmlspecialchars($_POST['question']);
            magic8Ball($question);
        }
        ?>
    </div>

    <!-- Audio Player-->
    <audio id="bg-music" loop autoplay>
        <source src="music/FortuneTeller.mp3" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>

</body>
</html>

