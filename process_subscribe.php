<?php
require "function.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["type"] == 'sub') {
        if (!empty($_POST["email"]) and !empty($_POST["notify-option"])) {
            $email = $_POST["email"];
            $type = $_POST["notify-option"];

            subscribe($email, (int)$type);

            http_response_code(201);
            echo json_encode([
                "status" => true,
                "message" => "Data subscribe sent"
            ]);
        } else {
            http_response_code(422);
            echo json_encode([
                "status" => false,
                "message" => "Field email and option required"
            ]);
        }
    }

    if ($_POST["type"] == 'unsub') {
        if (!empty($_POST["email"])) {
            $email = $_POST["email"];

            unsubscribe($email);

            http_response_code(201);
            echo json_encode([
                "status" => true,
                "message" => "Data unsubscribe sent"
            ]);
        } else {
            http_response_code(422);
            echo json_encode([
                "status" => false,
                "message" => "Field email and option required"
            ]);
        }
    }
}