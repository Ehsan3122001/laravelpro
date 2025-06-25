<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px #ccc;
        }

        h1 {
            text-align: center;
            font-size: 1.5rem;
        }

        p {
            margin-top: 20px;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .code {
            font-size: 1.5rem;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            background-color: #0056b3;
            box-shadow: 4px 5px 10px gray;
            margin: 0 16px;
            letter-spacing: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src={{ asset('Logo-mycommunication.svg') }} />
        <div style="display: flex;justify-content: center;align-items: center;">
            <img src={{ asset('lock.png') }} width="200" height="200" />
        </div>
        <div style="direction: rtl; margin-top: 50px;">
            <h1>إستعادة كلمة المرور</h1>
            <p style="margin-top: 40px;display: flex;flex-wrap: wrap;align-items: center;">رمز إستعادة كلمة المرور
                :<span class="code">{{ $number }}</span></p>
        </div>
        <p style="margin: 40px auto;text-align: center;color:gray;">تحذير: اذا لم تقم بإعادة تعيين كلمة المرور فتجاهل
            هذه الرسالة</p>
    </div>
</body>

</html>
