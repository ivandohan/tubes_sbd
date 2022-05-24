<?php
session_start();
if(!isset($_SESSION["login"])){
        header("Location: ../index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>tes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="layoutkuis/dragbar.css" />
    <link rel="stylesheet" href="layoutkuis/kuis.css" />
</head>


<body>
    <div class="navigation">
        <div class="toggle"></div>
        <ul>
            <li>
                <a href="../index.php">
                    <span class="icon">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </span>
                    <span class="title">Home</span>
                </a>
            </li>
            <li>
                <a href="../profil/profile.php">
                    <span class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                    <span class="title">Profil</span>
                </a>
            </li>
            <li>
                <a href="../acus/cus.php">
                    <span class="icon">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                    </span>
                    <span class="title">Contact Us</span>
                </a>
            </li>
            <li>
                <a href="../acus/aus.php">
                    <span class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </span>
                    <span class="title">About Us</span>
                </a>
            </li>
            <li>
                <a href="../ambi.php">
                    <span class="icon">
                        <i class="fa fa-child" aria-hidden="true"></i>
                    </span>
                    <span class="title">Kepribadian</span>
                </a>
            </li>
            <li>
                <a href="../functions_php/logout.php">
                    <span class="icon">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
    <div id="quiz-area">
        <section class="q-n-a">
            <h3 class="question">
                Username
            </h3>
            <div class="answers">
                <div class="answer" data-value="1">
                    <input type="text" id="username">

                </div>
            </div>
            <div class="button-holder clearfix">
                <div class="previous mini button">Previous</div>
                <div class="next mini button">Next</div>
            </div>
        </section>
        <section class="q-n-a">
            <h3 class="question">
                1. Dalam pekerjaan Anda, Anda paling produktif dengan cara kerja yang
                seperti apa?
            </h3>
            <div class="answers">
                <div class="answer" data-value="1">
                    A. Kerja mandiri dan independent aja
                </div>
                <div class="answer" data-value="2">
                    B. Sama 1-3 orang yang klop dengan saya, sendiri juga tidak masalah
                </div>
                <div class="answer" data-value="3">
                    C. Biar lebih cepat selesai kerja kelompok
                </div>
            </div>
            <div class="button-holder clearfix">
                <div class="previous mini button">Previous</div>
                <div class="next mini button">Next</div>
            </div>
        </section>

        <section class="q-n-a">
            <h3 class="question">
                2. Bagaimana reaksi Anda saat mendengar kabar yang mengejutkan?
            </h3>
            <div class="answers">
                <div class="answer" data-value="1">
                    A. Mencerna dan berfikir lebih dulu
                </div>
                <div class="answer" data-value="2">
                    B. Terlihat kaget dan tetap tenang bertanya kabar terkait
                </div>
                <div class="answer" data-value="3">
                    C. Lansung kaget dan menunjukkan reaksi
                </div>
            </div>
            <div class="button-holder clearfix">
                <div class="previous mini button">Previous</div>
                <div class="next mini button">Next</div>
            </div>
        </section>

        <section class="q-n-a">
            <h3 class="question">3. Aktivitas apa yang membuat Anda lupa waktu?</h3>
            <div class="answers">
                <div class="answer" data-value="1">
                    A. Saat santai sendiri, tiduran atau membaca dan menonton
                </div>
                <div class="answer" data-value="2">
                    B. Saat jalan-jalan keluar baik sendiri ataupun bersama teman
                </div>
                <div class="answer" data-value="3">
                    C. Saat ngobrol seru dengan teman-teman atau aktivitas luar
                </div>
            </div>
            <div class="button-holder clearfix">
                <div class="previous mini button">Previous</div>
                <div class="next mini button">Next</div>
            </div>
        </section>

        <section class="q-n-a">
            <h3 class="question">
                4. Kira-kira bagaimana penilaian orang lain terhadap Anda?
            </h3>
            <div class="answers">
                <div class="answer" data-value="1">
                    A. Saya orang yang serius, selalu berhati-hati dan mandiri
                </div>
                <div class="answer" data-value="2">
                    B. Saya tenang, enak diajak ngobrol dan bisa menjaga rahasia
                </div>
                <div class="answer" data-value="3">
                    C. Saya orang yang pandai bergaul, berkomunikasi dan aktif
                </div>
            </div>
            <div class="button-holder clearfix">
                <div class="previous mini button">Previous</div>
                <div class="next mini button">Next</div>
            </div>
        </section>

        <section class="q-n-a">
            <h3 class="question">
                5. Bagaimana cara Anda untuk mengisi energi agar mood Anda bagus dan
                bisa semangat seperti biasa?
            </h3>
            <div class="answers">
                <div class="answer" data-value="1">
                    A. Istirahat di rumah atau santai di tempat tenang sendiri
                </div>
                <div class="answer" data-value="2">
                    B. Nongkrong sendiri di cafe atau santai dengan sahabat dekat saja
                </div>
                <div class="answer" data-value="3">
                    C. Jalan ke mall, bertemu dengan teman-teman atau jalan-jalan
                </div>
            </div>
            <div class="button-holder clearfix">
                <div class="previous mini button">Previous</div>
                <div class="next mini button">Next</div>
            </div>
        </section>
    </div>
    <div class="button finish" style="display: none">What Am I?</div>
    <div class="response">
        <p></p>
        <div class="missed button" style="display: none">Check Answers</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

    <script type="text/javascript">
    var questions = $('.question').length;
    var total = 0;
    var avg = 0;
    var myQuestions = $('section.q-n-a');
    var currQ = 0;

    myQuestions.each(function(index) {
        var myAnswers = $(this).find('.answer');

        $(this).find('.answers').html(myAnswers);
        $(this).attr('id', index + 1);

        if (index == 0) {
            $(this).find('.previous').remove();
        }
    });

    $('#quiz-area').html(myQuestions);

    function showQ() {
        $('section.q-n-a').hide();
        currQ++;
        if ($('#' + currQ).length > 0) {
            $('#' + currQ).fadeIn(200);
        } else {
            $('.finish').fadeIn();
        }
    }
    showQ();
    $('.previous, .next, .missed').click(function() {
        if ($(this).hasClass('previous')) {
            currQ -= 2;
        } else if ($(this).hasClass('missed')) {
            currQ = 0;
            $('.response, .finish, .missed').hide();
        }
        showQ();
    });

    $('.answer').on('click', function() {
        if ($(this).parent().find('.selected').length > 0) {
            total -= $(this).parent().find('.selected').data('value');
            $(this).parent().find('.selected').removeClass('selected');
        }

        $(this).addClass('selected');
        total += $(this).data('value');

        console.log(total);
    });
    $('.finish').on('click', function() {
        avg = total / questions;
        var message = '';
        var kepribadian = '';
        var username = document.getElementById("username").value;

        if ($('.selected').length === questions) {
            if (avg < 1.5) {
                message = 'You Are Introvert';
                kepribadian = 'Introvert';

            } else if (avg < 2.5) {
                message = 'You Are Ambivert';
                kepribadian = 'Ambivert';
            } else if (avg < 5) {
                message = 'You Are Ekstrovert';
                kepribadian = 'Ekstrovert';
            }

            // $('#quiz-area, .finish').hide();
        } else {
            message = 'kamu belum jawab semua';
            $('.missed').show();
        }

        $.ajax({
            type: "POST",
            data: "sifat=" + kepribadian + "&username=" + username,
            url: 'includes/tambah.php',
            success: function(result) {
                console.log(result);
            }
        });

        $('.response p').text(message);
        $('.response').show();
    });
    </script>
    <script>
    const navigation = document.querySelector('.navigation');
    document.querySelector('.toggle').ondblclick = function() {
        this.classList.toggle('active');
        navigation.classList.toggle('active');
    };
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
    $(function() {
        $('.navigation').draggable();
    });
    </script>
</body>


</html>