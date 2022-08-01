<?php

include 'config.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQS PAGE</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .container {
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: #f2f2f2;
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;

        }

        h1 {
            text-align: center;
            font-family: "Roboto Slab", serif;
            font-size: 40px;
            text-transform: uppercase;

        }

        li {
            list-style: none;
            margin-bottom: 10px;
            padding: 15px;
            border-bottom: 2px solid #6d6b6b;
        }

        .question {
            font-family: Segoe UI;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            position: relative;
            color: #5c5a5a;
        }

        .icon-main {
            position: absolute;
            right: 0px;
            cursor: pointer;
        }

        .non-active {
            display: none;
        }

        .answer {
            font-size: 17px;
            font-family: Segoe UI;
            font-weight: 500;
        }
    </style>
    <title>F.A.Q's</title>
</head>

<body>
    <?php include 'header.php' ?>

    <div class="container">
        <h1>F.A.Q's</h1>
        <ul>
            <li class="faq">
                <div class="question">
                   Who can be given a certificate of good conduct?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                    </span>
                </div>
                <div class="answer non-active">
                In Kenya, a certificate of conduct is issued to Kenyans residing in the country, Kenyans residing in foreign countries, foreign citizens (who are not aliens or refugees in Kenya) and foreign citizens (who are aliens and refugees in Kenya).
                </div>
            </li>
            <li class="faq">
                <div class="question">
                What are the requirements of getting a certificate of good conduct?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                </div>
                <p class="answer non-active">
                In Kenya, a certificate of good conduct is easily obtained where one has various conditions. The first condition of acquiring the certificate is lack of any criminal records with the Kenya Police department. The finger prints of the Kenyan seeking a good conduct certificate are run through the system of criminal records. In cases where the prints have no record, the person will be issued with a certificate.
                </p>

            </li>
            <li class="faq">
                <div class="question">
                Where is the certificate of good conduct issued in Kenya?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                </div>
                <p class="answer non-active">
                The certificate of good conduct is issued from the Criminal Investigation Department in Kenya.For dwellers of Nairobi, the certificate of conduct is obtained from the CID headquarters. The location of Criminal Investigation Department headquarters in Nairobi is along Kiambu Road in Muthaiga area.For other persons in other parts of Kenya, outside Nairobi can obtain their certificate of conduct from the Divisional CID offices in various regions. The official receipt paid in the Divisional CID offices, the clear photocopy of the national ID, the prints taken, and a cover letter are usually forwarded to the Criminal Investigation Department (CID) headquarters.
                </p>
            </li>
            <li class="faq">
                <div class="question">
                What does a certificate of good conduct mean?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                </div>
                <p class="answer non-active">
                A certificate of good conduct means that the particular Kenyan holder has been searched in the criminal records of Kenya, and no criminal record has been traced. The validity of a certificate of good conduct is based on the information provided as from the date of issuance of the certificate.An employer in Kenya will require you to provide a valid certificate of good conduct or one that was taken at least three years ago. The certificate of good conduct in Kenya shows that a job candidate is of good morals, behaviors and obeys the law.
                </p>
            </li>
            <li class="faq">
                <div class="question">
                    Do I have to pay a cancellation fee if I cancel my reservation?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                </div>
                <p class="answer non-active">
                    A reservation cancellation fee pre-determined by the company may apply if you cancel your reservation.
                    No fee shall apply if the cancellation is made at 1 day prior to the date of pick-up. The cancellation fee shall apply for those made past the pickup date.

                </p>
            </li>
            <li class="faq">
                <div class="question">
                How long does the certificate of good conduct take before it is provided?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                </div>
                <p class="answer non-active">
                A certificate of good conduct in all parts of Kenya takes one to two weeks to be provided to a person who has applied.
                </p>
            </li>
            <li class="faq">
                <div class="question">
                Where to get the police abstract?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                </div>
                <p class="answer non-active">
                A police abstract can be downloaded from the Kenya police website.
                </p>
            </li>
            <li class="faq">
                <div class="question">
                What are the Kenya police entry requirement?
                    <span class="icon-main">
                        <i class="arrowdown">
                            <img src="images/arrowdown.png" alt="">
                        </i>
                </div>
                <p class="answer non-active">
                An applicant shall be a person who:
                  Is a citizen of Kenya.
                 Hold a Kenya National Identity Card.
                 Possess a minimum qualification of 'D+'( Plus) in the Kenya Certificate of Secondary Education (KCSE) examination with a ‘D+’ (Plus) in either English or Kiswahili
                </p>
            </li>
        </ul>
    </div>
    <script>
        // Toggle FAQs on click of icon
        document.querySelectorAll('.icon-main').forEach(function(icon) {
            icon.addEventListener('click', function() {
                var answer = this.parentElement.nextElementSibling;
                if (answer.classList.contains('non-active')) {
                    answer.classList.remove('non-active');
                    this.innerHTML = '<i class="arrowup"><img src="images/arrowup.png"></i>';
                } else {
                    answer.classList.add('non-active');
                    this.innerHTML = '<i class="arrowdown"><img src="images/arrowdown.png"></i>';
                }
            });
        });
    </script>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <?php include 'footer.php'; ?>


</body>

</html>