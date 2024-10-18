<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = $this->generateHTMLHeader();
        $output .= $this->generateProfileSection($profile);
        $output .= $this->generateHTMLFooter();

        $this->response = $output;
    }

    private function generateHTMLHeader()
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h1, h2 {
            text-align: center;
            color: #333;
            font-family: 'Georgia', serif;
        }
        p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
            text-align: justify;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 20px auto;
            display: block;
            border: 5px solid #fda085;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px auto;
            background-color: #fda085;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #f6d365;
        }
    </style>
</head>
<body>
<div class="container">
HTML;
    }

    private function generateProfileSection($profile)
    {
        $name = htmlspecialchars($profile->getName());
        $story = htmlspecialchars($profile->getStory());

        return <<<HTML
    <h1>Angeles University Foundation</h1>
    <img src="https://www.auf.edu.ph/home/images/articles/bya.jpg" alt="Founder Image" class="profile-img">
    <h2>$name</h2>
    <p><strong>Founder</strong></p>
    <p>$story</p>
    <a href="https://auf.edu.ph" class="button">Learn More</a>
HTML;
    }

    private function generateHTMLFooter()
    {
        return <<<HTML
</div>
</body>
</html>
HTML;
    }

    public function render()
    {
        header('Content-Type: text/html');
        return $this->response;
    }
}
