<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>
    body {
      background-color: #ede7f6;
      font-family: Roboto, Sans-serif;
    }

    .form {
      height: 1100px;
      width: 600px;
      margin: auto;
    }

    .required {
      font-size: 13px;
      color: red;
    }

    .title-div {
      height: 150px;
      width: 600px;
      background-color: #FDFEFE;
      margin: 15px;
      border-radius: 8px;
      border-top: 8px solid #6703c4;
      padding: 25px;
    }

    .name-div,
    .college-div,
    .gmail-div,
    .mobile-div {
      height: 150px;
      width: 650px;
      background-color: #FDFEFE;
      margin: 15px;
      border-radius: 8px;
    }

    .name {
      padding-top: 20px;
      padding-left: 25px;
      padding-bottom: 25px;
      font-size: 15px;
    }

    .input-div {
      padding-top: 25px;
      padding-left: 25px;
    }

    .input-div input {
      width: 300px;
      border: 0;
      outline: 0;
      border-bottom: 1.5px solid #DCD7D7;
      font-size: 15px;
    }

    .btn {
      height: 36px;
      width: 100px;
      background-color: #6703c4;
      border-radius: 5px;
      font-size: 14px;
      letter-spacing: .5px;
      font-weight: 540;
      border: none;
      padding: 10px;
      position: absolute;
      margin: 15px;
      color: white;
    }

    .last-div h2 {
      text-align: center;
      padding-top: 50px;
      color: #a2a4a6;
      font-weight: 200;
    }

    .term {
      font-size: 12px;
      padding-left: 65px;
      padding-top: 5px;
      position: absolute;
    }

    .never {
      padding-left: 15px;
      font-size: 12px;
      padding-top: 70px;
      font-weight: 400;

    }

  </style>
</head>

<body>
  <div class="form">
    <div class="title-div">
      <h1>SWAPAN MANDI</h1>
      <p>This is a google form. This form is created with HTML and CSS.</p>
      <p class="required">*Required</p>
    </div>

    <div class="name-div">
      <div class="name">What is your name?<span class="required">*</span></div>
      <div class="input-div"><input type="input" name="answer" placeholder="Your answer"></div>
    </div>

    <div class="college-div">
      <div class="name">Enter your college name.</div>
      <div class="input-div"><input type="input" name="answer" placeholder="Your answer"></div>
    </div>

    <div class="gmail-div">
      <div class="name">Enter your email.<span class="required">*</span></div>
      <div class="input-div"><input type="input" name="answer" placeholder="Your email"></div>
    </div>

    <div class="mobile-div">
      <div class="name">Enter your mobile no.</div>
      <div class="input-div"><input type="input" name="answer" placeholder="Your answer"></div>
    </div>

    <div>
      <input class="btn" type="submit" name="Submit">
    </div>

    <div class="last-div">
      <p class="never">Never submit passwords through Google Forms.</p>
      <p class="term">This content is neither created nor endorsed by Google, Report Abuse - Term of Service - Private
        Policy</p>
      <h2>Google Forms</h2>
    </div>






  </div>
</body>

</html>