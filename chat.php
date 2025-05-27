<?php
$chatFile = "chat.txt";

// Save new message if posted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $message = htmlspecialchars($_POST["message"]);
    $timestamp = date("d-m-Y h:i A");
    file_put_contents($chatFile, "[$timestamp] $name: $message\n", FILE_APPEND);
    header("Location: chat.php"); // redirect to avoid resubmission
    exit();
}

// Read chat messages
$messages = file_exists($chatFile) ? file($chatFile) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Chat 💌</title>
  <style>
    body { font-family: Arial; background: #fefefe; padding: 20px; }
    .chat-box { background: #f0f0f0; padding: 10px; height: 300px; overflow-y: scroll; border: 1px solid #ccc; margin-bottom: 20px; }
    .chat-box pre { margin: 0; }
  </style>
</head>
<body>
  <h2>Hey love, here’s our chat 💖</h2>
  <div class="chat-box">
    <pre><?php foreach ($messages as $msg) echo htmlspecialchars($msg); ?></pre>
  </div>

  <form method="post">
    <input type="text" name="name" placeholder="Your name" required>
    <br><br>
    <textarea name="message" placeholder="Type your sweet message..." rows="4" cols="40" required></textarea>
    <br><br>
    <button type="submit">Send 💌</button>
  </form>
</body>
</html>
