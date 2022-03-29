<!DOCTYPE html>
<html lang="en">
<head>    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,200;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet"> 
    <style>
    *, *::after, *::before {
    margin: 0;
    padding: 0;
    box-sizing: inherit;
    outline: none;
    }

    html {
    box-sizing: border-box;
    }

    .email__container {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(52, 143, 182, 0.2);
    font-size: 16px;
    }
    .email__content {
    max-width: 500px;
    margin: 50px auto;
    padding: 50px 20px 70px 20px;
    background-color: #fff;
    font-family: "Source Sans Pro", sans-serif;
    color: rgba(27, 38, 49, 0.9);
    line-height: 1.5;
    }
    .email__text {
    margin-bottom: 1rem;
    font-weight: 500;
    color: rgba(45, 64, 82, 0.9);
    }
    .email__title {
    font-family: "Poppins", sans-serif;
    font-size: 26px;
    font-weight: 200;
    text-align: center;
    margin-bottom: 40px;
    }
    .email__title b {
    font-weight: 600;
    }
    .email__button, .email__button:visited, .email__button:link {
    padding: 1rem 3rem;
    background-color: #5aceff;
    color: #fff;
    margin: 4rem auto;
    display: block;
    width: 200px;
    text-align: center;
    text-transform: capitalize;
    text-decoration: none;
    font-size: 18px;
    border-radius: 0.3rem;
    }

    </style>

    <!-- <link rel="stylesheet" href="./app/static/css/style.css"> -->
</head>
<body>
    <div class="email__container">
    <div class="email__content">
        <!-- <img src="./app/static/images/fav.svg" alt="" class="email__img"> -->
        <div class="email__title">Activation your <b>MY</b>Admin Account</div>
        <div class="email__text">Hi Christopher</div>
        <div class="email__text">
            A new account has been create with chris12aug@yahoo.com. 
            Pleace activate your account by click the button below.
        </div>
        <a href="" class="email__button">account activation</a>
        <div class="email__text">
            ...or else, by copying and pasting the following link in to your bowser:
        </div>
        <a href="<?php echo $link ?>" class="email__link"><?php echo $link ?></a>
    </div>
    </div>
</body>
</html>