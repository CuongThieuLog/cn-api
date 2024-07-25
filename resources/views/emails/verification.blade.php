<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f3f4f6;
    }

    .app {
        min-width: 100vw;
        min-height: 100vh;
        padding: 2rem 1rem;
        box-sizing: border-box;
    }

    .mail__wrapper {
        max-width: 28rem;
        margin: 0 auto;
        padding: 1rem;
        box-sizing: border-box;
    }

    .mail__content {
        background-color: #ffffff;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 0.375rem;
    }

    .content__header {
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 1rem;
    }

    .text-red {
        color: #BD191C;
        font-size: 0.875rem;
        font-weight: 700;
    }

    h1 {
        font-size: 1.875rem;
        height: 12rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    .content__body {
        padding: 2rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .confirm-button {
        color: #ffffff;
        background-color: #BD191C;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        width: 100%;
        margin-top: 2rem;
        padding: 1rem;
        border: none;
        cursor: pointer;
    }

    .confirm-button a {
        color: #ffffff;
        text-decoration: none;
    }

    .content__footer {
        margin-top: 2rem;
        text-align: center;
        color: #6b7280;
    }

    .content__footer h3 {
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .meta__social {
        display: flex;
        justify-content: center;
        margin: 1rem 0;
    }

    .social-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        background-color: #000000;
        color: #ffffff;
        text-decoration: none;
        margin-right: 1rem;
    }

    .social-icon:last-child {
        margin-right: 0;
    }

    .meta__help {
        text-align: center;
        font-size: 0.875rem;
        color: #4b5563;
    }

    .meta__help a {
        color: #4b5563;
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .mail__wrapper {
            padding: 0.5rem;
        }

        .content__header h1 {
            font-size: 1.5rem;
            height: auto;
        }

        .confirm-button {
            font-size: 0.75rem;
            padding: 0.75rem;
        }

        .meta__social {
            flex-direction: column;
            align-items: center;
        }

        .social-icon {
            margin-bottom: 0.5rem;
        }

        .social-icon:last-child {
            margin-bottom: 0;
        }
    }
    </style>
</head>

<body>
    <div class="app">
        <div class="mail__wrapper">
            <div class="mail__content">
                <div class="content__header">
                    <div class="text-red">CN Booking</div>
                    <h1>E-mail Confirmation</h1>
                </div>
                <div class="content__body">
                    <p>
                        Hi {{ $user->name }}!<br><br>
                        Thanks for signing up for CN Booking App. Please confirm your email by clicking the button
                        below.
                    </p>

                    <button class="confirm-button">
                        <a href="{{ route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]) }}"
                            class="verify-button">CONFIRM EMAIL ADDRESS</a>
                    </button>
                    <p>
                        CN'!<br> Your The CN teams
                    </p>
                </div>
                <div class="content__footer">
                    <h3>Thanks for using CN Booking!</h3>
                    <p>www.cn.io</p>
                </div>
            </div>
            <div class="mail__meta">
                <div class="meta__social">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                </div>
                <div class="meta__help">
                    <p>
                        Questions or concerns? <a href="mailto:help@theapp.io">admin@cn.io</a>
                        <br> Want to quit getting updates? <a href="#">Unsubscribe</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>